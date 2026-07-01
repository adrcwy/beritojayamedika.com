@extends('layouts.public')

@section('title', 'Kontak Toko Alkes Surabaya - PT. Berito Jaya Medika')
@section('meta_description', 'Hubungi PT. Berito Jaya Medika untuk konsultasi kebutuhan alat kesehatan, alat medis, alat laboratorium, dan pengadaan alkes di Surabaya maupun seluruh Indonesia.')
@section('meta_keywords', 'kontak alkes surabaya, toko alkes surabaya, hubungi distributor alkes, supplier alat medis surabaya')
@section('canonical', route('contact'))

@section('content')
<section class="bg-gradient-to-br from-blue-50 via-white to-red-50 py-20 lg:py-28">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 text-sm font-semibold rounded-full mb-8 shadow-sm">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                Siap Membantu Kebutuhan Alat Kesehatan Anda
            </span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-blue-900 leading-tight mb-6">
                Hubungi PT. Berito Jaya Medika
            </h1>
            <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto">
                Konsultasikan kebutuhan alat kesehatan, laboratorium, dan alat medis Anda dengan tim kami.
            </p>
        </div>
    </div>
</section>

<section class="bg-white py-16 lg:py-24">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-lg">
                <div class="w-12 h-12 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center mb-5">
                    <i class="fa-solid fa-location-dot text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-blue-900 mb-3">Alamat</h2>
                <p class="text-gray-600 leading-relaxed">
                    Jl. Achmad Jais No.34, Ruko Grand Achmad Jais Blok C-2, Peneleh, Genteng, Surabaya, Jawa Timur 60274
                </p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-lg">
                <div class="w-12 h-12 bg-red-100 text-red-700 rounded-xl flex items-center justify-center mb-5">
                    <i class="fa-solid fa-phone text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-blue-900 mb-3">Telepon</h2>
                <p class="text-gray-600 leading-relaxed">031-5450538</p>
                <p class="text-gray-600 leading-relaxed">Senin-Sabtu, 08.00-16.00 WIB</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-lg">
                <div class="w-12 h-12 bg-green-100 text-green-700 rounded-xl flex items-center justify-center mb-5">
                    <i class="fa-solid fa-message text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-blue-900 mb-3">Kritik & Saran</h2>
                <p class="text-gray-600 leading-relaxed mb-5">Kirim masukan langsung melalui formulir yang tersedia di website.</p>
                <button type="button" @click="feedbackModalOpen = true" class="inline-flex items-center justify-center px-5 py-3 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition">
                    Tulis Masukan
                </button>
            </div>
        </div>
    </div>
</section>
@endsection
