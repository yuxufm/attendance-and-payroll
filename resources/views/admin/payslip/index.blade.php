@extends('layouts.index')

@section('content')
    @php($_title = 'Payslip')
    @php($_link = 'payslip')

    <div class="flex flex-auto justify-between">
        <div>
            <h1 class="anp-title">{{ $_title }}</h1>
        </div>
        <div>
            <a href="{{ url("admin/$_link/buat") }}" class="anp-submit">
                Buat {{ $_title }}
            </a>
        </div>
    </div>

    <table id="tabel_{{ $_link }}" class="text-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th>Id User</th>
                <th>Nama</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Gaji Pokok Bulanan</th>
                <th>Benefit BPJS Dari Perusahaan</th>
                <th>Benefit Ketenagakerjaan Dari Perusahaan</th>
                <th>Total Penghasilan Bruto</th>
                <th>Potongan BPJS Pekerja</th>
                <th>Potongan Ketenagakerjaan Pekerja</th>
                <th>Potongan Absen Kerja</th>
                <th>Total Potongan</th>
                <th>Total Penerimaan</th>
            </tr>
        </thead>
        <tbody>
            @php($namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'])
            @foreach ($data as $item)
                <tr>
                    <td class="w-[50px]">{{ $loop->iteration }}.</td>
                    <td>#{{ $item->id_user }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $namaBulan[$item->bulan_gaji - 1] }}</td>
                    <td>{{ $item->tahun_gaji }}</td>
                    <td>{{ number_format($item->gaji_pokok_bulanan) }}</td>
                    <td>{{ number_format($item->benefit_bpjs_dari_perusahaan) }}</td>
                    <td>{{ number_format($item->benefit_ketenagakerjaan_dari_perusahaan) }}</td>
                    <td>{{ number_format($item->total_penghasilan_bruto) }}</td>
                    <td>{{ number_format($item->potongan_bpjs_pekerja) }}</td>
                    <td>{{ number_format($item->potongan_ketenagakerjaan_pekerja) }}</td>
                    <td>{{ number_format($item->potongan_absen_jam_kerja) }}
                        <div class="text-xs">
                            (Absen: {{ $item->total_absen_jam_kerja }}jam; Kerja: {{ $item->total_jam_kerja }}jam)
                        </div>
                    </td>
                    <td>{{ number_format($item->total_potongan) }}</td>
                    <td class="font-semibold text-base">Rp. {{ number_format($item->total_penerimaan) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $("#tabel_{{ $_link }}").DataTable();
        });
    </script>
@endsection
