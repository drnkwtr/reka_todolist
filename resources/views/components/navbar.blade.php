<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0">
        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
            <span class="fs-5 fw-bold">Reka Test Task (Todo List)</span>
        </a>
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="{{ route('homepage') }}" class="nav-link px-2">Home</a></li>
        <li><a href="{{ route('todolist.index') }}" class="nav-link px-2">Todo List</a></li>
    </ul>

    <div class="col-md-3 text-end">
        @auth
            <span class="me-2">Welcome, {{ Auth::user()->email }}</span>
            <form action="{{ route('auth.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        @else
            <a href="{{ route('auth.login.index') }}" class="btn btn-outline-primary me-2">Login</a>
            <a href="{{ route('auth.register.index') }}" class="btn btn-primary">Register</a>
        @endauth
    </div>
</header>
