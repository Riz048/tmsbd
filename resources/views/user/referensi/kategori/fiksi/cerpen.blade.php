@extends('layoutsuser.app')

@section('title', 'Novel')

@section('content')
<div class="py-12 px-6 md:px-20 bg-gradient-to-b from-header-bg-riwayat to-white min-h-[90vh]">

    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                <h1 class="text-2xl sm:text-4xl font-extrabold text-primary-blue mt-20 leading-tight">
                    Cerpen
                </h1>
                <div class="mt-4 md:mt-0 relative w-full md:w-80">
                    <input type="text" placeholder="Cari..." class="w-full py-2 pl-4 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-blue">
                    <button class="absolute right-0 top-0 mt-3 mr-3 text-gray-500 hover:text-primary-blue">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>

    {{-- Book Grid --}}
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4
            gap-x-4
            gap-y-10
            max-w-[1100px] mx-auto text-primary-blue">

    @for ($row=0; $row < 3; $row++)
        @for ($col=0; $col < 4; $col++)

            {{-- Card Buku (DIPAKAI UNTUK SEMUA ITEM) --}}
            <div class="relative w-44 h-64 rounded overflow-hidden shadow-md">
                
                {{-- Foto buku --}}
                <img 
                    src="/path/to/harrypotter.jpg" 
                    alt="Harry Potter" 
                    class="w-full h-full object-cover" 
                />

                {{-- Overlay gelap --}}
                <div class="absolute bottom-0 left-0 right-0 h-20 
                            bg-gradient-to-t from-black/80 to-transparent"></div>

                {{-- Judul buku --}}
                <div class="absolute bottom-2 left-2 right-2 
                            text-white text-sm font-semibold drop-shadow select-none">
                    Harry Potter dan Si Anak Terkutuk #8
                </div>

            </div>

        @endfor
    @endfor

</div>


    {{-- Pagination --}}
    <div class="flex justify-center items-center space-x-3 mt-10 text-primary-blue font-semibold">
        <button class="p-2 bg-white text-primary-blue rounded-full shadow hover:bg-gray-100">&lt;</button>

        @for ($i = 1; $i <= 5; $i++)
            <button class="w-8 h-8 rounded-full 
                {{ $i == 3 ? 'bg-primary-blue text-white' : 'bg-white' }} 
                shadow hover:bg-gray-100">
                {{ $i }}
            </button>
        @endfor

        <button class="p-2 bg-white text-primary-blue rounded-full shadow hover:bg-gray-100">&gt;</button>
    </div>

</div>
@endsection