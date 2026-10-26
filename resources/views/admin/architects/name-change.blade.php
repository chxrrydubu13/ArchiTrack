<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verified Name Change | ArchiTrack</title>
    @vite(['resources/css/app.css'])
    <style>
        body { margin:0; font-family:Inter,system-ui,sans-serif; background:#f4f6fa; color:#1f2937; }
        main { max-width:760px; margin:50px auto; padding:0 20px 50px; }
        .panel { background:white; border:1px solid #e2e8f0; border-radius:16px; padding:30px; box-shadow:0 10px 35px #15213a0c; }
        .eyebrow { font-size:12px; letter-spacing:.12em; font-weight:800; color:#b45309; }
        h1 { font-size:26px; margin:8px 0; } p { color:#64748b; line-height:1.6; }
        label { display:block; font-weight:700; font-size:13px; margin:20px 0 7px; }
        input:not([type=checkbox]),select,textarea { box-sizing:border-box; width:100%; padding:12px; border:1px solid #cbd5e1; border-radius:9px; font:inherit; background:white; }
        input[readonly] { background:#f1f5f9; color:#475569; }
        textarea { min-height:110px; resize:vertical; }
        .errors { border:1px solid #fecaca; background:#fff1f2; padding:14px; border-radius:9px; color:#991b1b; }
        .actions { display:flex; flex-wrap:wrap; gap:12px; align-items:center; margin-top:25px; }
        .btn { border:0; border-radius:9px; padding:13px 20px; font:inherit; font-weight:700; cursor:pointer; text-decoration:none; }
        .primary { background:#db6c20; color:white; } .secondary { background:#e2e8f0; color:#1e293b; }
        .confirm { display:flex; align-items:flex-start; gap:10px; margin-top:22px; font-size:13px; }
        small { color:#64748b; } .confirm label { margin:0; font-weight:500; }
    </style>
</head>
<body>
<main>
    <div class="panel">
        <span class="eyebrow">PROFESSIONAL IDENTITY VERIFICATION</span>
        <h1>Request Verified Name Change</h1>
        <p>This is a sensitive professional identity change. A supporting document and fresh administrator password are required. The original name and change history will be retained.</p>
        @if ($errors->any())
            <div class="errors" role="alert"><strong>Unable to process the request.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.architects.name-change.store', $architect->id) }}" enctype="multipart/form-data">
            @csrf
            <label for="old_name">Current Registered Name</label>
            <input id="old_name" value="{{ $architect->name }}" readonly>
            <label for="new_name">Proposed Full Name</label>
            <input id="new_name" name="new_name" value="{{ old('new_name') }}" maxlength="100" minlength="2" autocomplete="off" required>
            <label for="reason">Reason for Name Change</label>
            <select id="reason" name="reason" required>
                <option value="">Select a reason</option>
                @foreach (['marriage' => 'Marriage', 'legal_change' => 'Legal Name Change', 'spelling_correction' => 'Spelling or Registration Correction', 'other' => 'Other Documented Reason'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('reason') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <label for="explanation">Detailed Explanation</label>
            <textarea id="explanation" name="explanation" minlength="10" maxlength="1000" placeholder="Explain why the registered professional name needs to be changed." required>{{ old('explanation') }}</textarea>
            <label for="proof">Supporting Document</label>
            <input id="proof" name="proof" type="file" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required>
            <small>PDF, JPG, or PNG only. Maximum 5 MB. Stored privately; not publicly accessible.</small>
            <label for="admin_password">Administrator Password (Fresh Verification)</label>
            <input id="admin_password" name="admin_password" type="password" autocomplete="current-password" required>
            <div class="confirm"><input id="confirm_name_change" name="confirm_name_change" value="1" type="checkbox" required><label for="confirm_name_change">I have reviewed the supporting evidence and confirm that this change is justified. I understand the change will be permanently recorded in the audit history.</label></div>
            <div class="actions">
                <button class="btn primary" type="submit" onclick="return confirm('Confirm this verified professional name change? The action will be audited.')">Verify and Change Name</button>
                <a class="btn secondary" href="{{ route('admin.architects.edit', $architect->id) }}">Cancel</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>
