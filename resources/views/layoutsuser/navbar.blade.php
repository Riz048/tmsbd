<nav class="bg-white shadow-md py-6 px-6 flex justify-between items-center fixed top-0 left-0 right-0 z-50">
    <div class="flex items-center space-x-3">
        <div class="bg-gray-200 w-10 h-10 flex items-center justify-center rounded font-bold text-primary-blue">📚</div>
        <div class="font-semibold text-sm leading-tight">
            <div class="text-primary-blue">Perpustakaan</div>
            <div class="text-primary-blue">SMAN 1 Hamparan Perak</div>
        </div>
    </div>
    <ul class="hidden md:flex space-x-8 text-primary-blue font-medium">
        <li><a href="{{ route('beranda') }}#beranda" class="hover:text-blue-600">Beranda</a></li>
        <li><a href="{{ route('beranda') }}#tentang" class="hover:text-blue-600">Tentang</a></li>
        <li><a href="{{ route('beranda') }}#layanan" class="hover:text-blue-600">Layanan</a></li>
        <li><a href="{{ route('beranda') }}#kontak" class="hover:text-blue-600">Kontak</a></li>
    </ul>

    <div>
        @guest
            <a href="{{ route('login') }}"
            class="bg-primary-blue hover:bg-dark-blue text-white text-sm font-semibold py-2 px-5 rounded">
                Login
            </a>
        @endguest

        @auth
            <span class="text-primary-blue font-semibold text-sm">
                {{ Auth::user()->nama }} 👋
            </span>
        @endauth
    </div>

</nav>