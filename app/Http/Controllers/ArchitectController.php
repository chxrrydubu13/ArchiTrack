<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use App\Mail\ArchitectAccountMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ArchitectController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | SUSPEND ARCHITECT
    |--------------------------------------------------------------------------
    */

    public function suspend($id)
    {
        $architect = User::where('role', 'architect')
            ->findOrFail($id);


        $architect->status = 'suspended';

        $architect->save();


        // AUDIT LOG
        AuditLog::create([
            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Architect Suspended',

            'details' =>
                'Suspended architect account for '
                . $architect->name
                . '.',
        ]);


        return redirect()
            ->route('admin.architects.index')
            ->with(
                'success',
                'Architect account suspended successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | ACTIVATE ARCHITECT
    |--------------------------------------------------------------------------
    */

    public function activate($id)
    {
        $architect = User::where('role', 'architect')
            ->findOrFail($id);


        $architect->status = 'active';

        $architect->save();


        // AUDIT LOG
        AuditLog::create([
            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Architect Activated',

            'details' =>
                'Activated architect account for '
                . $architect->name
                . '.',
        ]);


        return redirect()
            ->route('admin.architects.index')
            ->with(
                'success',
                'Architect account activated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW ALL ARCHITECTS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $architects = User::whereRaw(
            'LOWER(role) = ?',
            ['architect']
        )
        ->orderBy('name', 'asc')
        ->get();


        return view(
            'admin.architects.index',
            compact('architects')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.architects.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE ARCHITECT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[\pL\s.\'-]+$/u',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
        ], [
            'name.required' =>
                'Please enter the architect name.',

            'name.min' =>
                'The architect name must have at least 2 characters.',

            'name.max' =>
                'The architect name cannot exceed 100 characters.',

            'name.regex' =>
                'The architect name must only contain letters.',

            'email.required' =>
                'Please enter the architect email address.',

            'email.email' =>
                'Please enter a valid email address.',

            'email.unique' =>
                'This email address is already registered.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | TEMPORARY PASSWORD
        |--------------------------------------------------------------------------
        */

        $tempPassword = Str::random(10);


        /*
        |--------------------------------------------------------------------------
        | CREATE ACCOUNT
        |--------------------------------------------------------------------------
        */

        $architect = new User();


        $architect->name = trim(
            $request->name
        );


        $architect->email = strtolower(
            trim($request->email)
        );


        $architect->password = Hash::make(
            $tempPassword
        );


        $architect->role = 'architect';


        $architect->status = 'active';


        $architect->must_change_password = true;


        $architect->save();


        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG
        |--------------------------------------------------------------------------
        */

        AuditLog::create([
            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Architect Created',

            'details' =>
                'Created architect account for '
                . $architect->name
                . ' (' . $architect->email . ').',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEND EMAIL
        |--------------------------------------------------------------------------
        */

        Mail::to(
            $architect->email
        )->send(

            new ArchitectAccountMail(
                $architect,
                $tempPassword
            )

        );


        return redirect()
            ->route('admin.architects.index')
            ->with(
                'success',
                'Architect account created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT ARCHITECT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $architect = User::whereRaw(
            'LOWER(role) = ?',
            ['architect']
        )
        ->findOrFail($id);


        return view(
            'admin.architects.edit',
            compact('architect')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE ARCHITECT
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        $id
    )
    {
        $architect = User::whereRaw(
            'LOWER(role) = ?',
            ['architect']
        )
        ->findOrFail($id);


        $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
                'regex:/^[\pL\s.\'-]+$/u',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $architect->id,
            ],

            'status' => [
                'required',
                'in:active,inactive,suspended',
            ],
        ], [
            'name.required' =>
                'Please enter the architect name.',

            'name.regex' =>
                'The architect name must only contain letters.',

            'email.required' =>
                'Please enter an email address.',

            'email.email' =>
                'Please enter a valid email address.',

            'email.unique' =>
                'This email address is already being used.',

            'status.required' =>
                'Please select an account status.',

            'status.in' =>
                'Please select a valid account status.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SAVE OLD VALUES FOR AUDIT LOG
        |--------------------------------------------------------------------------
        */

        $oldName = $architect->name;

        $oldEmail = $architect->email;

        $oldStatus = $architect->status;


        /*
        |--------------------------------------------------------------------------
        | UPDATE ACCOUNT
        |--------------------------------------------------------------------------
        */

        $architect->name = trim(
            $request->name
        );


        $architect->email = strtolower(
            trim($request->email)
        );


        $architect->status =
            $request->status;


        $architect->save();


        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG
        |--------------------------------------------------------------------------
        */

        $changes = [];


        if ($oldName !== $architect->name) {

            $changes[] =
                'name changed from "'
                . $oldName
                . '" to "'
                . $architect->name
                . '"';

        }


        if ($oldEmail !== $architect->email) {

            $changes[] =
                'email changed from "'
                . $oldEmail
                . '" to "'
                . $architect->email
                . '"';

        }


        if ($oldStatus !== $architect->status) {

            $changes[] =
                'status changed from "'
                . $oldStatus
                . '" to "'
                . $architect->status
                . '"';

        }


        if (count($changes) > 0) {

            $details =
                'Updated architect account for '
                . $architect->name
                . ': '
                . implode(', ', $changes)
                . '.';

        } else {

            $details =
                'Opened and saved architect account for '
                . $architect->name
                . ' with no changes.';

        }


        AuditLog::create([
            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Architect Updated',

            'details' => $details,
        ]);


        return redirect()
            ->route('admin.architects.index')
            ->with(
                'success',
                'Architect account updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | RESET PASSWORD
    |--------------------------------------------------------------------------
    */

    public function resetPassword($id)
    {
        $architect = User::whereRaw(
            'LOWER(role) = ?',
            ['architect']
        )
        ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | CREATE NEW TEMPORARY PASSWORD
        |--------------------------------------------------------------------------
        */

        $tempPassword = Str::random(10);


        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */

        $architect->password = Hash::make(
            $tempPassword
        );


        $architect->must_change_password = true;


        $architect->save();


        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG
        |--------------------------------------------------------------------------
        */

        AuditLog::create([
            'user_id' => auth()->id(),

            'user_name' => auth()->user()->name,

            'action' => 'Architect Password Reset',

            'details' =>
                'Generated a new temporary password for '
                . $architect->name
                . '.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SEND EMAIL
        |--------------------------------------------------------------------------
        */

        Mail::to(
            $architect->email
        )->send(

            new ArchitectAccountMail(
                $architect,
                $tempPassword
            )

        );


        return redirect()
            ->route('admin.architects.index')
            ->with(
                'success',
                'Architect password was reset successfully. A new temporary password was sent to the architect.'
            );
    }

}