@extends('layoutsuser.app')

@section('title', ucfirst($tipe))

@section('content')

<div class="min-h-screen bg-[#EBF0F5] px-6 py-16">

    <h1 class="text-4xl font-bold text-primary-blue mb-10">
        Kategori {{ ucfirst($tipe) }}
    </h1>

    {{-- FILTER KATEGORI --}}
    <div class="mb-10">
        <h2 class="font-semibold mb-3">Pilih Sub-Kategori:</h2>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('user.kategori.show', $tipe) }}"
               class="px-4 py-2 rounded-lg 
               {{ $kategoriDipilih ? 'bg-gray-300' : 'bg-primary-blue text-white' }}">
                Semua
            </a>

            @foreach ($daftarKategori as $kat)
                <a href="{{ route('user.kategori.show', $tipe) }}?kategori={{ $kat }}"
                   class="px-4 py-2 rounded-lg
                   {{ $kategoriDipilih === $kat ? 'bg-primary-blue text-white' : 'bg-white' }}">
                    {{ $kat }}
                </a>
            @endforeach

        </div>
    </div>

    {{-- DAFTAR BUKU --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

        @forelse ($buku as $b)
            <a href="{{ route('detail.buku', $b->id) }}"
               class="bg-white rounded-lg shadow-md overflow-hidden">

                <img src="{{ bookImage($b->gambar) }}"
                     class="w-full h-40 object-cover">

                <div class="p-3">
                    <p class="font-semibold line-clamp-2 text-primary-blue">{{ $b->judul }}</p>
                    <p class="text-sm text-gray-600">{{ $b->pengarang }}</p>
                </div>

            </a>
        @empty
            <p class="text-gray-500">Tidak ada buku ditemukan.</p>
        @endforelse

    </div>

</div>

@endsection
