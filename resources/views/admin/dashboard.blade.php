<h1>Admin Dashboard</h1>
<a href="{{ route('admin.logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   Logout
</a>

<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
