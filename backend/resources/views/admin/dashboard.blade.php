<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="{{true ? "": ""}}text-2xl font-bold mb-6">Welcome to Admin Dashboard</h1>
        <p>Only accessible to authenticated admins.</p>
        <a href="{{ route('admin.edit', 'about') }}" class="text-indigo-600 hover:text-indigo-900">About page</a>
        <a href="{{ route('contact.page') }}" class="text-indigo-600 hover:text-indigo-900">Contact page</a>
    </div>
</body>
</html>