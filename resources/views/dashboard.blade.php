<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-6 text-white shadow-lg">
                <p class="text-sm uppercase tracking-[0.2em] text-blue-100">Sistem UET</p>
                <h1 class="mt-2 text-3xl font-bold">Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }}</h1>
                <p class="mt-2 max-w-2xl text-blue-100">
                    Sila lengkapkan borang UET dan ikuti status permohonan anda dengan mudah melalui sistem digital ini.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Peranan</p>
                    <h3 class="mt-3 text-2xl font-bold text-slate-900">Pengguna</h3>
                    <p class="mt-2 text-sm text-slate-600">Pemohon borang UET</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Status Permohonan</p>
                    <h3 class="mt-3 text-2xl font-bold text-amber-600">Dalam Proses</h3>
                    <p class="mt-2 text-sm text-slate-600">Tiada permohonan lagi</p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Tindakan</p>
                    <a href="{{ route('uet-form') }}" class="mt-4 inline-flex items-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Isi Borang UET
                    </a>
                </div>
            </div>

            <div class="mt-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-wide text-slate-500">Borang UET</p>
                        <h2 class="mt-1 text-2xl font-bold text-slate-900">Permohonan Transfer / Penyerahan</h2>
                    </div>
                    <a href="{{ route('uet-form') }}" class="inline-flex items-center rounded-xl border border-blue-600 px-4 py-2 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">
                        Buka borang
                    </a>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2">
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Nama Pegawai</p>
                        <p class="mt-2 font-semibold text-slate-900">{{ Auth::user()->name ?? 'Nama pemohon' }}</p>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Tarikh Permohonan</p>
                        <p class="mt-2 font-semibold text-slate-900">{{ now()->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
