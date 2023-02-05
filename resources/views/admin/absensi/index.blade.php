@extends('layouts.index')

@section('content')
    @php($_title = 'Absensi')
    @php($_link = 'absensi')

    <div class="flex flex-auto justify-between">
        <div>
            <h1 class="anp-title">Riwayat {{ $_title }}</h1>
        </div>
    </div>

    <table id="tabel_{{ $_link }}" class="text-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th>Id User</th>
                <th>Nama</th>
                <th>Tgl</th>
                <th>Jam Masuk Kerja</th>
                <th>Jam Selesai Kerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="w-[50px]">{{ $loop->iteration }}.</td>
                    <td>#{{ $item->id_user }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tgl_absensi }}</td>
                    <td>{{ $item->jam_masuk ? $item->jam_masuk . ' WIB' : '-' }}</td>
                    <td>{{ $item->jam_keluar ? $item->jam_keluar . ' WIB' : '-' }}</td>
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
