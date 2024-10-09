<!-- login.blade.php -->
<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <input type="email" name="email" placeholder="Admin Email" required>
    <input type="password" name="password" placeholder="Admin Password" required>
    <button type="submit">Login</button>
</form>
