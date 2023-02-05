@extends('layouts.index')

@section('content')
    @php($_title = 'Payslip')
    @php($_link = 'payslip')

    <h1 class="anp-title block">Buat {{ $_title }} Untuk Semua Pegawai</h1>
    <form class="mt-16 w-[500px]" action="/admin/{{ $_link }}/buat" method="POST">
        @csrf

        @include('components.flash_alert', [
            'message' => session()->get('message'),
            'alert' => session()->get('alert'),
        ])

        @php($_label_width = 'w-[100px]')

        <div class="flex flex-row mb-7">
            <div class="{{ $_label_width }}">
                <label class="anp-label">Tahun</label>
            </div>
            <div class="flex-1">
                <select name="tahun" class="anp-select">
                    @for ($tahun = 2023; $tahun < date('Y') + 3; $tahun++)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="flex flex-row mb-7">
            <div class="{{ $_label_width }}">
                <label class="anp-label">Bulan</label>
            </div>
            <div class="flex-1">
                <select name="bulan" class="anp-select">
                    @php($namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'])
                    @for ($bulan = 1; $bulan <= 12; $bulan++)
                        <option {{ $bulan == date('m') ? 'selected' : null }} value="{{ $bulan }}">
                            {{ $namaBulan[$bulan - 1] }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="flex flex-row mt-16">
            <div class="w-[300px]">
                <button type="submit" class="anp-submit">Buat Payslip</button>
            </div>
            <div class="flex-1">
                <div class="w-[100px] float-right">
                    <a href="{{ url("admin/$_link") }}">
                        <button type="button" class="anp-submit">Kembali</button>
                    </a>
                </div>
            </div>
        </div>

    </form>
@endsection
