@extends('layouts.public')

@section('title', 'Proyek Pengadaan Alkes - PT. Berito Jaya Medika Surabaya')
@section('meta_description', 'Dokumentasi proyek dan pengalaman PT. Berito Jaya Medika dalam pengadaan alat kesehatan, alat medis, dan distribusi alkes untuk fasilitas kesehatan.')
@section('meta_keywords', 'proyek pengadaan alkes, pengadaan alat kesehatan, distributor alkes surabaya, pt. berito jaya medika')
@section('canonical', route('projects'))

@section('content')
<section class="bg-gradient-to-br from-blue-50 via-white to-blue-50 py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-full mb-8 shadow-sm">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                Portofolio Pengadaan dan Distribusi
            </span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-blue-900 leading-tight mb-6">
                Proyek dan Pengalaman Kami
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto">
                Dokumentasi proyek dan kerja sama PT. Berito Jaya Medika dalam mendukung kebutuhan fasilitas kesehatan.
            </p>
        </div>
    </div>
</section>

<section class="bg-white py-16 lg:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        @if($projects->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <article class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-lg">
                        @if($project->image)
                            <img src="{{ url('/media/' . ltrim($project->image, '/')) }}" alt="{{ $project->title }}" class="w-full h-56 object-cover">
                        @else
                            <div class="w-full h-56 bg-gradient-to-br from-blue-100 to-red-100 flex items-center justify-center">
                                <i class="fa-solid fa-hospital text-5xl text-blue-700"></i>
                            </div>
                        @endif

                        <div class="p-6">
                            <h2 class="text-xl font-bold text-blue-900 mb-2">{{ $project->title }}</h2>
                            @if($project->client_name)
                                <p class="text-sm font-semibold text-red-600 mb-3">{{ $project->client_name }}</p>
                            @endif
                            <p class="text-gray-600 leading-relaxed">{{ $project->description }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="max-w-2xl mx-auto text-center bg-blue-50 border border-blue-100 rounded-2xl p-10">
                <div class="w-16 h-16 bg-blue-700 text-white rounded-2xl flex items-center justify-center mx-auto mb-5">
                    <i class="fa-solid fa-clipboard-list text-2xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-blue-900 mb-3">Data proyek belum tersedia</h2>
                <p class="text-gray-600">Portofolio proyek akan ditampilkan di halaman ini setelah data ditambahkan.</p>
            </div>
        @endif
    </div>
</section>
@endsection
