@extends('layoutsuser.app')

@section('title', 'Beranda')

@section('content')

<!-- Part 1: Hero Section -->
<section
  id="beranda" class="min-h-screen flex flex-col-reverse md:flex-row justify-between items-center px-8 md:px-16 lg:px-32"
  style="background: linear-gradient(180deg, rgba(235, 240, 245, 1) 0%, rgba(235, 240, 245, 0) 100%);"
>
  <div class="text-center md:text-left mt-8 md:mt-0">
    <h2 class="text-primary-blue text-3xl md:text-5xl font-semibold">Selamat Datang di</h2>
    <h2 class="text-primary-blue text-3xl md:text-5xl font-semibold mt-2 mb-4">Portal Perpustakaan Digital</h2>
    <div class="bg-primary-blue text-white font-bold text-3xl md:text-5xl inline-block px-3 py-3 mt-2">
      SMA Negeri 1 Hamparan Perak
    </div>
  </div>

  <div class="text-primary-blue font-medium">
    <div class="w-56 h-56 md:w-72 md:h-72 bg-gray-200 flex items-center justify-center rounded-xl shadow-inner">
      GAMBAR
    </div>
  </div>
</section>


<!-- Part 2: Profil Sekolah -->
<section id="tentang" class="scroll-mt-12 min-h-screen flex flex-col justify-center px-8 md:px-16 lg:px-32 bg-white">
  <h3 class="text-white bg-primary-blue inline-block px-5 py-3 font-bold text-4xl my-12">
    Tentang 
  </h3>

  <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-10">
    <div class="text-center md:text-left text-primary-blue font-medium mb-6 md:mb-0">
      <div class="w-52 h-52 md:w-64 md:h-64 bg-gray-200 flex items-center justify-center rounded-xl shadow-inner">
        GAMBAR
      </div>
    </div>

    <div>
      <h3 class="text-primary-blue font-semibold mb-3 text-lg md:text-xl">
        Tentang SMA Negeri 1 Hamparan Perak
      </h3>
      <p class="text-sm text-justify leading-relaxed mb-4">
        <strong>SMA Negeri 1 Hamparan Perak</strong> adalah sekolah menengah atas yang berkomitmen menciptakan
        lingkungan belajar unggul, berkarakter, dan berlandaskan nilai iman serta ilmu. Dengan semangat kolaborasi,
        kami berupaya melahirkan generasi cerdas dan berintegritas.
      </p>

      <p class="text-sm text-justify leading-relaxed mb-4">
        <strong>Visi & Misi</strong><br>
        <b>Visi:</b> Menjadi sekolah yang unggul dalam prestasi, berdaya saing tinggi, berlandaskan iman dan takwa.<br>
        <b>Misi:</b> Menumbuhkan semangat belajar, karakter, dan kreativitas melalui pembelajaran inovatif dan budaya literasi.
      </p>

      <p class="text-sm text-justify leading-relaxed">
        <strong>Sasaran Program Sekolah</strong><br>
        Meningkatkan kehadiran peserta didik di atas 95%, memperluas penerimaan ke perguruan tinggi negeri,
        serta memperkuat budaya disiplin dan tanggung jawab.
      </p>
    </div>
  </div>

  <div class="mt-10 mb-6 flex flex-col md:flex-row justify-center items-center gap-6">
    <div class="bg-primary-blue text-white w-40 h-28 rounded-xl shadow-lg flex flex-col justify-center items-center">
      <div class="text-3xl font-bold">🏫</div>
      <div class="text-2xl font-semibold">SMAN 1</div>
      <p class="text-sm text-center">Hamparan Perak</p>
    </div>

    <div class="bg-primary-blue text-white w-40 h-28 rounded-xl shadow-lg flex flex-col justify-center items-center">
      <div class="text-3xl font-bold">📍</div>
      <p class="text-sm text-center leading-tight">
        Jl. Titi Payung – Bulu Cina<br>Hamparan Perak, Deli Serdang
      </p>
    </div>
  </div>
</section>

<section id="layanan" class="-scroll-mt-10 min-h-screen flex flex-col justify-start items-center py-36 bg-[#F5F7FC] text-center">
    <h3 class="text-primary-blue font-semibold text-4xl mb-4">
        Nikmati <span class="bg-primary-blue font-bold text-white px-3 py-2">Layanan Perpustakaan</span>
    </h3>
    <h4 class="text-primary-blue font-semibold text-4xl mb-16">SMA Negeri 1 Hamparan Perak</h4>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 justify-center max-w-6xl mx-auto">

        <!-- BOX TRANSAKSI -->
        <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition max-w-sm mx-auto">
            
            <div class="mb-3 flex justify-center">
                <img src="{{ bookImage(null) }}"
                     alt="Transaksi" 
                     class="h-56 w-auto object-contain rounded-lg shadow-sm">
            </div>

            <h5 class="font-bold text-primary-blue mb-1">Transaksi</h5>
            <p class="text-sm text-gray-600">Layanan peminjaman dan </br> pengembalian buku.</p>

            <div class="text-right mt-2">
                <a href="{{ route('user.transaksi.riwayat') }}" class="bg-primary-blue text-xs text-white font-semibold px-3 py-1 rounded-lg ">Selengkapnya →</a>
            </div>

        
        </div>

        <!-- BOX REFERENSI -->
        <div class="bg-white rounded-2xl shadow-md p-4 hover:shadow-lg transition max-w-sm mx-auto">
            
            <div class="mb-3 flex justify-center">
                <img src="{{ bookImage(null) }}" 
                     alt="Transaksi" 
                     class="h-56 w-auto object-contain rounded-lg shadow-sm">
            </div>

            <h5 class="font-bold text-primary-blue mb-1">Referensi</h5>
            <p class="text-sm text-gray-600">Koleksi digital untuk </br> menunjang pembelajaran.</p>
            <div class="text-right mt-2">
                <a href="{{ route('user.referensi.home') }}" class="bg-primary-blue text-xs text-white font-semibold px-3 py-1 rounded-lg ">Selengkapnya →</a>
            </div>
        </div>

    </div>
</section>



    <!-- Part 4 -->
    <section id="kontak" class="scroll-mt-8 px-8 md:px-16 lg:px-32 py-16 bg-white text-center">
        <h3 class="text-white bg-primary-blue inline-block px-5 py-3 font-bold text-4xl mb-12">
    Kontak 
  </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 justify-center">
            <div class="bg-primary-blue text-white rounded-xl shadow-md p-5 flex flex-col items-center text-center">
                <h5 class="font-bold mb-1">Alamat</h5>
                <p class="text-sm">Jalan Titi Payung - Bulu Cina Hamparan Perak</p>
            </div>
            <div class="bg-primary-blue text-white rounded-xl shadow-md p-5 flex flex-col items-center text-center">
                <h5 class="font-bold mb-1">Telepon</h5>
                <p class="text-sm">08xx xxx xxx</p>
            </div>
            <div class="bg-primary-blue text-white rounded-xl shadow-md p-5 flex flex-col items-center text-center">
                <h5 class="font-bold mb-1">Email</h5>
                <p class="text-sm">hamparanperak560@gmail.com</p>
            </div>
            <div class="bg-primary-blue text-white rounded-xl shadow-md p-5 flex flex-col items-center text-center">
                <h5 class="font-bold mb-1">Jam Operasional</h5>
                <p class="text-sm">Senin–Jumat: 07:00–16:00<br>Sabtu: 07:00–12:00 WIB</p>
            </div>
        </div>
    </section>

@endsection
