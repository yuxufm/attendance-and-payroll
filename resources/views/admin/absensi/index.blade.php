@extends('layouts.index')

@section('content')
    @php($_title = 'Absensi')
    @php($_link = 'absensi')

    <div class="flex flex-auto justify-between">
        <div>
            <h1 class="anp-title">Data {{ $_title }}</h1>
        </div>
    </div>

    <table id="tabel_{{ $_link }}" class="text-sm">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jabatan</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($data as $item)
                <tr>
                    <td class="w-[50px]">{{ $loop->iteration }}.</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $("#tabel_{{ $_link }}").DataTable();
        });
    </script>
@endsection
