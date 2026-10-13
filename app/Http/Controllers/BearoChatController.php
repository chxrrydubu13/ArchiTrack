<?php

namespace App\Http\Controllers;

use App\Models\BearoSetting;
use App\Models\BearoUsageStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BearoChatController extends Controller
{
    public function chat(Request $request)
    {
        $setting = BearoSetting::current();

        /*
        |--------------------------------------------------------------------------
        | CHECK IF BEARO IS ENABLED
        |--------------------------------------------------------------------------
        */

        if (!$setting->enabled) {
            return response()->json([
                'message' => 'Bearo is currently unavailable.',
            ], 503);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE MESSAGE
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'min:1',
                'max:500',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | RECORD USAGE
        |--------------------------------------------------------------------------
        */

        if ($setting->save_usage_logs) {
            BearoUsageStat::addToToday('messages');
        }

        /*
        |--------------------------------------------------------------------------
        | OPENAI API KEY
        |--------------------------------------------------------------------------
        */

        $apiKey = config('services.openai.key');

        if (empty($apiKey)) {

            if ($setting->save_usage_logs) {
                BearoUsageStat::addToToday(
                    'failed_replies'
                );
            }

            Log::error(
                'Bearo OpenAI API key is missing.'
            );

            return response()->json([
                'message' =>
                    'Bearo is temporarily unavailable.',
            ], 500);
        }

        /*
        |--------------------------------------------------------------------------
        | CONVERSATION HISTORY
        |--------------------------------------------------------------------------
        */

        $history = session()->get(
            'bearo_history',
            []
        );

        /*
         * Keep only valid user/assistant messages.
         */
        $history = array_values(
            array_filter(
                $history,
                function ($message) {
                    return
                        is_array($message)
                        &&
                        isset(
                            $message['role'],
                            $message['content']
                        )
                        &&
                        in_array(
                            $message['role'],
                            [
                                'user',
                                'assistant',
                            ],
                            true
                        )
                        &&
                        is_string(
                            $message['content']
                        );
                }
            )
        );

        /*
         * Add current visitor message.
         */
        $history[] = [
            'role' => 'user',
            'content' => trim(
                $validated['message']
            ),
        ];

        /*
         * Keep recent conversation only.
         */
        $history = array_slice(
            $history,
            -10
        );

        /*
        |--------------------------------------------------------------------------
        | BEARO PERSONALITY
        |--------------------------------------------------------------------------
        */

        $tone = trim(
            (string) $setting->tone_instructions
        );

        if ($tone === '') {
            $tone =
                'Friendly, helpful, clear, concise, and approachable.';
        }

        /*
        |--------------------------------------------------------------------------
        | BEARO INSTRUCTIONS
        |--------------------------------------------------------------------------
        */

        $instructions = <<<PROMPT
You are Bearo, the friendly AI assistant on the public ArchiTrack website for Vero Designs Architectural Services.

PERSONALITY

{$tone}

CORE BEHAVIOR

- Sound like a real conversational website assistant, not a scripted FAQ.
- Respond naturally to follow-up questions using recent conversation context.
- Follow the visitor's language and tone.
- You may reply in English or Taglish.
- Keep replies concise unless the visitor asks for more detail.
- Never claim to be human.

WHAT ARCHITRACK IS

ArchiTrack is an architectural project management and collaboration system used by Vero Designs Architectural Services.

It centralizes project communication, project progress, phases, milestones, files, revisions, meetings, and client collaboration in one system.

PUBLIC FEATURES YOU MAY EXPLAIN

- Architectural project management
- Ten structured project phases
- Project progress tracking
- Project milestones
- Architect progress updates
- Project files
- File version history
- Client revision requests
- Revision reference attachments
- Architect revision responses
- Project-specific messaging
- Project communication
- Meeting requests
- Meeting approval
- Meeting rejection
- Meeting rescheduling
- AI-assisted structuring of client revision feedback
- Project insights and summaries
- Role-based access
- Admin accounts
- Architect accounts
- Client accounts
- Account authentication
- Project permissions
- Notifications

ARCHITRACK PROJECT PHASES

ArchiTrack uses ten structured project phases.

The system allows architects and clients to follow the project's progress through these phases while keeping related milestones, updates, files, and project activity organized.

Do not invent a project's current phase or progress percentage.

AI IN ARCHITRACK

ArchiTrack may use AI to help organize client revision feedback into a clearer structure.

AI supports organization and communication.

AI does not replace the architect's professional judgment or decision-making.

ACCESS RULES

- Clients receive project access through an invitation from their architect.
- Architect accounts are created by an authorized administrator.
- There is no public self-registration for project access.
- Users can only access information allowed by their role and assigned projects.
- Do not invent account credentials.
- Do not invent project status.
- Do not invent private files.
- Do not invent client information.
- Do not invent schedules.
- Do not invent internal project data.
- You cannot access a visitor's private ArchiTrack account or project from this public landing-page chatbot.
- If someone asks about a specific private project, tell them to sign in to ArchiTrack or contact Vero Designs.

SITE GUIDANCE

The public ArchiTrack landing page contains:

- Home
- About Us
- Architects
- Features
- Contact
- Privacy
- Terms
- Log In

DATA PRIVACY

ArchiTrack recognizes the importance of protecting personal and project-related information.

The system follows the principles of the Data Privacy Act of 2012, Republic Act No. 10173, by collecting information for legitimate purposes, limiting access based on user roles and assigned permissions, and applying appropriate security measures.

Privacy principles presented on the website include:

- Data Collection
- Controlled Access
- Data Security
- User Rights
- Data Retention
- Responsible Handling

SAFETY AND PRIVACY

- Never ask for passwords.
- Never ask for API keys.
- Never ask for payment details.
- Never ask for other account secrets.
- If a visitor shares a password or secret, tell them not to share credentials in the chat.
- Do not expose private system information.
- Do not pretend that you performed actions you cannot perform.
- Do not claim that you can see private project information.

COMPANY-SPECIFIC INFORMATION

If you are unsure about company-specific information:

- Say you are not certain.
- Recommend contacting Vero Designs.
- Do not invent an answer.

UNRELATED QUESTIONS

If someone asks something unrelated to ArchiTrack or Vero Designs:

- You may answer very briefly if the question is harmless.
- Then guide the conversation back to ArchiTrack or Vero Designs when appropriate.

STYLE

- Usually respond in 1 to 4 short sentences.
- Be conversational.
- Be helpful.
- Avoid unnecessary corporate jargon.
- Avoid overly technical explanations unless requested.
- Avoid repeating the visitor's entire question.
- If the visitor seems unsure, end with one useful next-step suggestion.
- Do not use markdown tables.
PROMPT;

        /*
        |--------------------------------------------------------------------------
        | MODEL
        |--------------------------------------------------------------------------
        |
        | Use the current Bearo model.
        |
        | We intentionally use gpt-6-luna here instead of allowing an old
        | database model value to override it. This prevents an outdated
        | BearoSetting model value from breaking the chatbot.
        |
        */

        $model = config(
            'services.openai.bearo_model',
            'gpt-6-luna'
        );

        if (
            empty($model)
            ||
            $model === 'gpt-5.6-luna'
        ) {
            $model = 'gpt-6-luna';
        }

        /*
        |--------------------------------------------------------------------------
        | MAX OUTPUT TOKENS
        |--------------------------------------------------------------------------
        */

        $maxOutputTokens =
            (int) (
                $setting->max_output_tokens
                ?: 300
            );

        /*
         * Keep the public chatbot reasonably concise.
         */
        $maxOutputTokens = max(
            100,
            min(
                $maxOutputTokens,
                600
            )
        );

        /*
        |--------------------------------------------------------------------------
        | OPENAI RESPONSES API PAYLOAD
        |--------------------------------------------------------------------------
        */

        $payload = [
            'model' =>
                $model,

            'instructions' =>
                $instructions,

            'input' =>
                $history,

            'max_output_tokens' =>
                $maxOutputTokens,

            'store' =>
                false,
        ];

        /*
        |--------------------------------------------------------------------------
        | SEND REQUEST
        |--------------------------------------------------------------------------
        */

        try {

            $response = Http::withToken(
                $apiKey
            )
                ->acceptJson()
                ->asJson()
                ->connectTimeout(10)
                ->timeout(45)
                ->retry(
                    2,
                    500,
                    function ($exception, $request) {
                        return true;
                    },
                    throw: false
                )
                ->post(
                    'https://api.openai.com/v1/responses',
                    $payload
                );

            /*
            |--------------------------------------------------------------------------
            | FAILED OPENAI RESPONSE
            |--------------------------------------------------------------------------
            */

            if (!$response->successful()) {

                $status =
                    $response->status();

                $responseData =
                    $response->json();

                if ($setting->save_usage_logs) {

                    if ($status === 429) {
                        BearoUsageStat::addToToday(
                            'rate_limited'
                        );
                    } else {
                        BearoUsageStat::addToToday(
                            'failed_replies'
                        );
                    }
                }

                Log::warning(
                    'Bearo OpenAI request failed',
                    [
                        'status' =>
                            $status,

                        'model' =>
                            $model,

                        'body' =>
                            $responseData,
                    ]
                );

                /*
                 * Friendly public error.
                 *
                 * We intentionally do not expose OpenAI's raw
                 * API error to visitors.
                 */
                return response()->json([
                    'message' =>
                        $setting->fallback_message
                        ?: 'Sorry, I lost the connection for a moment. You can try sending that again.',
                ], 502);
            }

            /*
            |--------------------------------------------------------------------------
            | READ OPENAI RESPONSE
            |--------------------------------------------------------------------------
            */

            $data =
                $response->json();

            $reply =
                $this->getReplyText(
                    $data
                );

            /*
            |--------------------------------------------------------------------------
            | EMPTY RESPONSE
            |--------------------------------------------------------------------------
            */

            if (!$reply) {

                if ($setting->save_usage_logs) {
                    BearoUsageStat::addToToday(
                        'failed_replies'
                    );
                }

                Log::warning(
                    'Bearo received an empty OpenAI response.',
                    [
                        'model' =>
                            $model,

                        'response_id' =>
                            $data['id'] ?? null,

                        'status' =>
                            $data['status'] ?? null,

                        'incomplete_details' =>
                            $data['incomplete_details']
                            ?? null,
                    ]
                );

                return response()->json([
                    'message' =>
                        $setting->fallback_message
                        ?: 'Sorry, I could not generate a reply. Please try again.',
                ], 502);
            }

            /*
            |--------------------------------------------------------------------------
            | SAVE CONVERSATION HISTORY
            |--------------------------------------------------------------------------
            */

            $history[] = [
                'role' =>
                    'assistant',

                'content' =>
                    $reply,
            ];

            session()->put(
                'bearo_history',
                array_slice(
                    $history,
                    -10
                )
            );

            /*
            |--------------------------------------------------------------------------
            | SUCCESS STAT
            |--------------------------------------------------------------------------
            */

            if ($setting->save_usage_logs) {
                BearoUsageStat::addToToday(
                    'successful_replies'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | RETURN REPLY
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'reply' =>
                    $reply,
            ]);

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | UNEXPECTED ERROR
            |--------------------------------------------------------------------------
            */

            if ($setting->save_usage_logs) {
                BearoUsageStat::addToToday(
                    'failed_replies'
                );
            }

            Log::error(
                'Bearo chatbot error',
                [
                    'message' =>
                        $e->getMessage(),

                    'file' =>
                        $e->getFile(),

                    'line' =>
                        $e->getLine(),

                    'model' =>
                        $model,
                ]
            );

            return response()->json([
                'message' =>
                    $setting->fallback_message
                    ?: 'Sorry, Bearo is temporarily unavailable. Please try again.',
            ], 500);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | RESET CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function reset(Request $request)
    {
        $request
            ->session()
            ->forget(
                'bearo_history'
            );

        return response()->json([
            'ok' => true,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | PUBLIC BEARO SETTINGS
    |--------------------------------------------------------------------------
    */

    public function publicSettings()
    {
        $setting =
            BearoSetting::current();

        return response()->json([
            'enabled' =>
                (bool) $setting->enabled,

            'greeting_title' =>
                $setting->greeting_title,

            'greeting_text' =>
                $setting->greeting_text,

            'idle_reset_minutes' =>
                $setting->idle_reset_minutes,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | EXTRACT TEXT FROM RESPONSES API
    |--------------------------------------------------------------------------
    */

    private function getReplyText(
        array $data
    ): ?string
    {
        $parts = [];

        /*
         * Responses API returns generated messages
         * inside the output array.
         */
        foreach (
            $data['output'] ?? []
            as
            $item
        ) {

            if (
                ($item['type'] ?? null)
                !==
                'message'
            ) {
                continue;
            }

            foreach (
                $item['content'] ?? []
                as
                $content
            ) {

                if (
                    ($content['type'] ?? null)
                    ===
                    'output_text'
                    &&
                    isset(
                        $content['text']
                    )
                    &&
                    is_string(
                        $content['text']
                    )
                ) {

                    $text =
                        trim(
                            $content['text']
                        );

                    if ($text !== '') {
                        $parts[] =
                            $text;
                    }
                }
            }
        }

        $reply =
            trim(
                implode(
                    "\n",
                    $parts
                )
            );

        return $reply !== ''
            ? $reply
            : null;
    }
}