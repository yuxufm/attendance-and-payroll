@extends('layouts.index')

@section('content')
    @php($_title = 'Absensi')
    @php($_link = 'absensi')

    @include('components.flash_alert', [
        'message' => session()->get('message'),
        'alert' => session()->get('alert'),
    ])

    <div class="flex flex-col bg-gray-200 rounded-lg p-10 mb-10">
        <div class="font-semibold text-lg text-center mb-10">
            {{ $tgl }}
        </div>
        <div>
            <div class="flex flex-row">
                @if (empty($dataAbsenHariIni->jam_masuk))
                    <a href="{{ url('pegawai/absensi/masuk-kerja') }}" class="anp-submit mx-10">
                        Masuk Kerja
                    </a>
                @endif

                @if (!empty($dataAbsenHariIni->jam_masuk) && empty($dataAbsenHariIni->jam_keluar))
                    <a href="{{ url('pegawai/absensi/selesai-kerja') }}" class="anp-submit mx-10 disabled">
                        Selesai Kerja
                    </a>
                @endif

                @if (!empty($dataAbsenHariIni->jam_masuk) && !empty($dataAbsenHariIni->jam_keluar))
                    <a href="#" class="anp-submit mx-10" style="background-color: rgb(0, 167, 11)">
                        Have a good day! 🙂
                    </a>
                @endif
            </div>
        </div>
    </div>


    <div class="flex flex-auto justify-between">
        <div>
            <h1 class="anp-title">Riwayat {{ $_title }}</h1>
        </div>
    </div>

    <table id="tabel_{{ $_link }}" class="text-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tgl</th>
                <th>Jam Masuk Kerja</th>
                <th>Jam Selesai Kerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td class="w-[50px]">{{ $loop->iteration }}.</td>
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
