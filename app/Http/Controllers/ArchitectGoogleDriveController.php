<?php

namespace App\Http\Controllers;

use App\Models\GoogleDriveConnection;
use Google\Client as GoogleClient;
use Google\Service\Oauth2 as GoogleOauth2;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArchitectGoogleDriveController extends Controller
{
    public function connect()
    {
        $state = Str::random(40);

        session([
            'google_drive_oauth_state' => $state,
        ]);

        $client = $this->makeGoogleClient();

        $client->setState($state);

        return redirect()->away(
            $client->createAuthUrl()
        );
    }


    public function callback(Request $request)
    {
        if ($request->filled('error')) {
            return redirect()
                ->route('architect.reports.index')
                ->with(
                    'error',
                    'Google Drive connection was cancelled.'
                );
        }

        $expectedState =
            session()->pull(
                'google_drive_oauth_state'
            );

        $receivedState =
            $request->get('state');

        if (
            !$expectedState
            ||
            !$receivedState
            ||
            !hash_equals(
                $expectedState,
                $receivedState
            )
        ) {
            return redirect()
                ->route('architect.reports.index')
                ->with(
                    'error',
                    'Google Drive connection could not be verified. Please try again.'
                );
        }

        $code =
            $request->get('code');

        if (!$code) {
            return redirect()
                ->route('architect.reports.index')
                ->with(
                    'error',
                    'Google did not return an authorization code.'
                );
        }

        $client =
            $this->makeGoogleClient();

        $token =
            $client->fetchAccessTokenWithAuthCode(
                $code
            );

        if (
            isset($token['error'])
            ||
            empty($token['access_token'])
        ) {
            return redirect()
                ->route('architect.reports.index')
                ->with(
                    'error',
                    'Google Drive authorization failed. Please try again.'
                );
        }

        $client->setAccessToken(
            $token
        );

        $googleAccountId = null;
        $googleEmail = null;

        try {
            $oauthService =
                new GoogleOauth2(
                    $client
                );

            $googleUser =
                $oauthService
                    ->userinfo
                    ->get();

            $googleAccountId =
                $googleUser->getId();

            $googleEmail =
                $googleUser->getEmail();

        } catch (\Throwable $exception) {
            //
        }

        $existingConnection =
            GoogleDriveConnection::where(
                'user_id',
                auth()->id()
            )
                ->first();

        $refreshToken =
            $token['refresh_token']
            ??
            $existingConnection?->refresh_token;

        $expiresIn =
            (int) (
                $token['expires_in']
                ?? 3600
            );

        GoogleDriveConnection::updateOrCreate(
            [
                'user_id' =>
                    auth()->id(),
            ],
            [
                'google_account_id' =>
                    $googleAccountId,

                'google_email' =>
                    $googleEmail,

                'access_token' =>
                    $token['access_token'],

                'refresh_token' =>
                    $refreshToken,

                'token_expires_at' =>
                    now()->addSeconds(
                        max(
                            0,
                            $expiresIn - 60
                        )
                    ),

                'scope' =>
                    is_array(
                        $token['scope']
                        ?? null
                    )
                        ? implode(
                            ' ',
                            $token['scope']
                        )
                        : (
                            $token['scope']
                            ?? implode(
                                ' ',
                                $client->getScopes()
                            )
                        ),
            ]
        );

        return redirect()
            ->route(
                'architect.reports.index'
            )
            ->with(
                'success',
                'Google Drive connected successfully.'
            );
    }


    public function disconnect()
    {
        $connection =
            GoogleDriveConnection::where(
                'user_id',
                auth()->id()
            )
                ->first();

        if ($connection) {
            try {
                $client =
                    $this->makeGoogleClient();

                $client->revokeToken(
                    $connection->access_token
                );

            } catch (\Throwable $exception) {
                //
            }

            $connection->delete();
        }

        return redirect()
            ->route(
                'architect.reports.index'
            )
            ->with(
                'success',
                'Google Drive disconnected.'
            );
    }


    private function makeGoogleClient(): GoogleClient
    {
        $client =
            new GoogleClient();

        $client->setClientId(
            config(
                'services.google_drive.client_id'
            )
        );

        $client->setClientSecret(
            config(
                'services.google_drive.client_secret'
            )
        );

        $client->setRedirectUri(
            config(
                'services.google_drive.redirect_uri'
            )
        );

        $client->setAccessType(
            'offline'
        );

        $client->setPrompt(
            'consent'
        );

        $client->setIncludeGrantedScopes(
            true
        );

        $client->setScopes([
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/userinfo.email',
        ]);

        return $client;
    }
}
