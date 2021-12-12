<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">{{ \Illuminate\Support\Facades\Config::get('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('home') }}">Home</a></li>
                @auth('admin')
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4"
                           href="{{ route('admin.home') }}">Admin panel</a>
                    </li>
                @endauth
                @auth
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4"
                           href="{{ route('post.my') }}">My posts</a>
                    </li>
                    <li class="nav-item">
                        <form method="post" action="{{ route('auth.logout') }}">
                            @csrf
                            <button class="nav-link px-lg-3 py-3 py-lg-4 btn btn-link"
                                    style="color: #fff;font-size: 0.75rem;font-weight: 800;letter-spacing: 0.0625em;text-transform: uppercase;"
                                    type="submit">Logout</button>
                        </form>
                    </li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('post.create') }}">Create post</a></li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4"
                           href="{{ route('auth.login.index') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3 py-3 py-lg-4" href="{{ route('auth.register.index') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
