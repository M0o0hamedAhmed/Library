<nav class="navbar navbar-expand-lg navbar-light bg-light  p-3 ">
    <a class="navbar-brand" href="{{route('main')}}">Main</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link"  href="{{route('books.paginateBooks')}}">Books </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{route('authors.paginateAuthors')}}">Authors </a>
            </li>
           @guest()
                <li class="nav-item">
                    <a class="nav-link" href="{{route('auth.register')}}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('auth.login')}}">Login</a>
                </li>
            @endguest
            @auth()
            <li class="nav-item">
                <a class="nav-link " href="{{route('auth.logout')}}">Logout</a>
            </li>
                <li class="nav-item">
                    <a class="nav-link active" href=""> {{ Auth::user()->name  }} </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
