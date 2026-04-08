<!-- Header -->
    <header id="header" style="background-color: #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.1); padding: 10px 30px; position: fixed; width: 100%; top: 0; z-index: 1000;">
        <nav class="left">
            <a href="#menu"><span>Menu</span></a>
        </nav>
        <a href="{{ url('/') }}" class="logo">Pendaftaran Eskul</a>
        <nav class="right">

        @guest
            <!-- Kalau belum login -->
            <a href="{{ route('login') }}" class="button alt-danger">Masuk</a>
        @endguest

        @auth
            <!-- Kalau user sudah login -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn alt-danger">
                    Keluar
                </button>
            </form>
        @endauth

        </nav>
    </header>
    <!-- Header -->



    <!-- Menu -->
    <nav id="menu">
        <ul class="links">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ url('/') }}#eskul">Eskul</a></li>
            <li><a href="https://wa.me/6281234567890" target="_blank">Kontak</a></li>
        </ul>
    </nav>
    <!-- Menu -->