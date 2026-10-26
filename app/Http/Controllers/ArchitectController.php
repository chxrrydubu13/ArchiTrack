<?php







namespace App\Http\Controllers;







use App\Models\User;



use App\Models\AuditLog;



use App\Mail\ArchitectAccountMail;







use Illuminate\Http\Request;



use Illuminate\Support\Facades\Hash;



use Illuminate\Support\Facades\Mail;



use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\Storage;



use Illuminate\Validation\ValidationException;



use Illuminate\Validation\Rules\File;



use Illuminate\Support\Str;







class ArchitectController extends Controller



{







    /* Archive architect account permanently from the active directory. */

    public function archive($id)

    {

        $architect = DB::transaction(function () use ($id) {

            $architect = User::where('role', 'architect')->lockForUpdate()->findOrFail($id);

            if ($architect->status === 'archived') {

                return $architect;

            }

            $architect->status = 'archived';

            $architect->archived_at = now();

            $architect->save();

            AuditLog::create([

                'user_id' => auth()->id(),

                'user_name' => auth()->user()->name,

                'action' => 'Architect Archived',

                'details' => 'Archived architect account for ' . $architect->name

                    . '. Account eligible for automatic deletion after 30 days; project records retained.',

            ]);

            return $architect;

        });



        return redirect()->route('admin.architects.index')

            ->with('success', 'Architect account moved to Archived Accounts.');

    }



    /* Dedicated archive listing; no deletion action enabled until access rules are verified. */

    public function archived()

    {

        $architects = User::where('role', 'architect')

            ->where('status', 'archived')

            ->orderByDesc('archived_at')

            ->paginate(15);



        return view('admin.architects.archived', compact('architects'));

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



        ->where('status', '!=', 'archived')

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



        // Normalize whitespace before validating; do not alter capitalization.



        if (is_string($request->input('name'))) {



            $request->merge([



                'name' => preg_replace('/\s+/u', ' ', trim($request->input('name'))),



            ]);



        }







        $request->validate([



            'name' => [



                'required',



                'string',



                'min:2',



                'max:100',



                'regex:/^[\p{L}\p{M}]+(?:[ .\x27\x{2019}-][\p{L}\p{M}]+)*$/u',



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



                'Use letters and valid name separators (spaces, apostrophes, periods or hyphens); no numbers or symbols.',







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







        $tempPassword = Str::random(9) . '!';







        /*



        |--------------------------------------------------------------------------



        | CREATE ACCOUNT



        |--------------------------------------------------------------------------



        */







        $architect = new User();







        $architect->name = $request->input('name');







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











    private function architectEditUnlocked(Request $request, $id): bool



    {



        $grant = $request->session()->get('architect_edit_unlock');







        return is_array($grant)



            && (int) ($grant['admin_id'] ?? 0) === (int) auth()->id()



            && (int) ($grant['architect_id'] ?? 0) === (int) $id



            && (int) ($grant['expires_at'] ?? 0) > now()->timestamp;



    }







    public function unlockEdit(Request $request, $id)



    {



        User::where('role', 'architect')->where('status', '!=', 'archived')->findOrFail($id);







        $request->validate([



            'admin_password' => ['required', 'string'],



        ]);







        if (!Hash::check($request->input('admin_password'), auth()->user()->password)) {



            return back()->withErrors([



                'admin_password' => 'Incorrect administrator password. Editing remains locked.',



            ]);



        }







        $request->session()->regenerateToken();



        $request->session()->put('architect_edit_unlock', [



            'admin_id' => auth()->id(),



            'architect_id' => (int) $id,



            'expires_at' => now()->addMinutes(5)->timestamp,



        ]);







        return redirect()->route('admin.architects.edit', $id)



            ->with('success', 'Editing unlocked for five minutes.');



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



        ->where('status', '!=', 'archived')

        ->findOrFail($id);







        return view(



            'admin.architects.edit',



            ['architect' => $architect, 'editUnlocked' => $this->architectEditUnlocked(request(), $id), 'editUnlockExpiresAt' => (int) (request()->session()->get('architect_edit_unlock.expires_at') ?? 0)]



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



        ->where('status', '!=', 'archived')

        ->findOrFail($id);







        if (!$this->architectEditUnlocked($request, $id)) {



            return redirect()->route('admin.architects.edit', $id)



                ->withErrors(['unlock' => 'Editing is locked or has expired. Verify your administrator password again.']);



        }







        // Professional identity cannot be changed through ordinary account editing.



        // Reject crafted requests attempting to modify the name.



        if ($request->has('name') && $request->input('name') !== $architect->name) {



            throw ValidationException::withMessages([



                'name' => 'Professional name changes require the verified name change form.',



            ]);



        }







        $request->validate([



            'status' => ['required', 'in:active,on_hold'],
            'status_remarks' => ['required_if:status,on_hold', 'nullable', 'string', 'max:1000'],
            'email' => [



                'required',



                'email',



                'max:255',



                'unique:users,email,' . $architect->id,



            ],







            'password' => [



                'nullable',



                'string',



                'min:8',



                'confirmed',



                'regex:/[^\pL\pN\s]/u',



            ],



        ], [



            'name.required' =>



                'Please enter the architect name.',







            'name.regex' =>



                'Use letters and valid name separators (spaces, apostrophes, periods or hyphens); no numbers or symbols.',







            'email.required' =>



                'Please enter an email address.',







            'email.email' =>



                'Please enter a valid email address.',







            'email.unique' =>



                'This email address is already being used.',







            'password.min' =>



                'The new password must contain at least 8 characters.',







            'password.confirmed' =>



                'The password confirmation does not match.',







            'password.regex' =>



                'The new password must contain at least one special character.',



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











        $architect->email = strtolower(



            trim($request->email)



        );







        $passwordChanged = $request->filled('password');







        if ($passwordChanged) {



            $architect->password = Hash::make($request->input('password'));



            $architect->must_change_password = true;



        }







        $architect->status = $request->input('status');
        $architect->save();



        $request->session()->forget('architect_edit_unlock');







        /*



        |--------------------------------------------------------------------------



        | AUDIT LOG



        |--------------------------------------------------------------------------



        */







        $changes = [];
        if ($oldStatus !== $architect->status) {
            $changes[] = 'account status changed from ' . $oldStatus . ' to ' . $architect->status
                . ($architect->status === 'on_hold' ? '; reason: ' . trim($request->input('status_remarks', '')) : '');
        }







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







        if ($passwordChanged) {



            $changes[] = 'account password updated (password value not logged)';



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











    /** Verified identity changes require the same five-minute admin unlock. */



    public function showNameChange($id)



    {



        $architect = User::where('role', 'architect')->where('status', '!=', 'archived')->findOrFail($id);



        abort_unless($this->architectEditUnlocked(request(), $id), 403, 'Unlock architect editing first.');
        return view('admin.architects.name-change', compact('architect'));



    }







    public function storeNameChange(Request $request, $id)



    {



        $architect = User::where('role', 'architect')->where('status', '!=', 'archived')->findOrFail($id);
        abort_unless($this->architectEditUnlocked($request, $id), 403, 'Unlock architect editing first.');



        if (is_string($request->input('new_name'))) {



            $request->merge(['new_name' => preg_replace('/\s+/u', ' ', trim($request->input('new_name')))]);



        }







        $data = $request->validate([



            'new_name' => ['required', 'string', 'min:2', 'max:100',



                'regex:/^[\p{L}\p{M}]+(?:[ .\x27\x{2019}-][\p{L}\p{M}]+)*$/u'],



            'reason' => ['required', 'in:marriage,legal_change,spelling_correction,other'],



            'explanation' => ['required', 'string', 'min:10', 'max:1000'],



            'proof' => ['required', File::types(['pdf', 'jpg', 'jpeg', 'png'])->max('5mb')],



            'admin_password' => ['required', 'string'],



            'confirm_name_change' => ['accepted'],



        ]);







        if ($data['new_name'] === $architect->name) {



            throw ValidationException::withMessages(['new_name' => 'The new name must differ from the registered name.']);



        }



        if (!Hash::check($data['admin_password'], $request->user()->password)) {



            throw ValidationException::withMessages(['admin_password' => 'Administrator password is incorrect.']);



        }







        // Private local disk: never create a public/storage URL for evidence.



        $path = $request->file('proof')->store('architect-name-proofs', 'local');



        if (!$path) {



            throw ValidationException::withMessages(['proof' => 'Unable to securely store the supporting document.']);



        }







        try {



            DB::transaction(function () use ($architect, $data, $path, $request) {



                $locked = User::where('role', 'architect')->where('status', '!=', 'archived')->lockForUpdate()->findOrFail($architect->id);



                $oldName = $locked->name;



                $locked->name = $data['new_name'];



                $locked->save();







                $changeId = DB::table('architect_name_changes')->insertGetId([



                    'architect_id' => $locked->id,



                    'admin_id' => $request->user()->id,



                    'old_name' => $oldName,



                    'new_name' => $data['new_name'],



                    'reason' => $data['reason'],



                    'explanation' => $data['explanation'],



                    'proof_disk' => 'local',



                    'proof_path' => $path,



                    'created_at' => now(),



                    'updated_at' => now(),



                ]);







                AuditLog::create([



                    'user_id' => $request->user()->id,



                    'user_name' => $request->user()->name,



                    'action' => 'Architect Professional Name Changed',



                    'details' => 'Architect ID ' . $locked->id . ': professional name changed from "'



                        . $oldName . '" to "' . $data['new_name'] . '". Reason: '



                        . $data['reason'] . '. Verification record #' . $changeId



                        . '. Supporting proof retained in private storage.',



                ]);



            });



        } catch (\Throwable $e) {



            Storage::disk('local')->delete($path);



            throw $e;



        }







        return redirect()->route('admin.architects.edit', $architect->id)



            ->with('success', 'Verified professional name change saved and audited.');



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



        ->where('status', '!=', 'archived')

        ->findOrFail($id);







        /*



        |--------------------------------------------------------------------------



        | CREATE NEW TEMPORARY PASSWORD



        |--------------------------------------------------------------------------



        */







        $tempPassword = Str::random(9) . '!';







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
