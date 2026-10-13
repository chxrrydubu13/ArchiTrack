<!DOCTYPE html>
<html>
<head>
    <title>Architects</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Architect Accounts</h1>

            <a href="#"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Add Architect
            </a>
        </div>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">Name</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="p-3 border">{{ $user->name }}</td>
                        <td class="p-3 border">{{ $user->email }}</td>
                        <td class="p-3 border">{{ $user->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</body>
</html>