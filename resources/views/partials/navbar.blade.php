<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('post') }}">Portal Berita</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('post') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Request::is('categories') ? 'active' : '' }}" href="" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Category
                    </a>
                    <ul class="dropdown-menu">
                        @if ($Navcategories->count())
                            @foreach ($Navcategories as $category)
                                <li><a class="dropdown-item" href="/post?category={{ $category->slug }}">{{ $category->nama }}</a></li>
                            @endforeach
                        @else
                            <li><a class="dropdown-item" href="#">No Category Found</a></li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('jurnalis') ? 'active' : '' }}" href="{{ route('jurnalis') }}">Journalist</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('sign.out') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item">
                        <a class="nav-link btn btn-secondary text-white {{ Request::is('signin') ? 'active' : '' }}"
                            href="{{ route('sign.in') }}">
                            <i class="bi bi-box-arrow-in-left"></i> Sign In
                        </a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
