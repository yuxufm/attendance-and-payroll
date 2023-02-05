@extends('layouts.index')

@section('content')
    @php($_title = 'Payslip')
    @php($_link = 'payslip')

    <div class="flex flex-auto justify-between">
        <div>
            <h1 class="anp-title">{{ $_title }}</h1>
        </div>
    </div>

    <table id="tabel_{{ $_link }}" class="text-sm">
        <thead>
            <tr>
                <th>No.</th>
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
            @foreach ($data as $item)
                <tr>
                    <td class="w-[50px]">{{ $loop->iteration }}.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
