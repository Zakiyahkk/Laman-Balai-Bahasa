@extends('layouts.app')

@section('title', 'ZI-WBK ' . strtoupper($sub))

@section('content')
    <div class="container">

        <h3 class="mb-4">
            ZI-WBK {{ $tahun }} <br>
            <small>{{ ucwords(str_replace('-', ' ', $area)) }}</small>
        </h3>

        <h5 class="mb-3">
            {{ ucwords(str_replace('-', ' ', $sub)) }}
        </h5>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Dokumen</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokumen as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $item->file) }}" target="_blank" class="btn btn-sm btn-primary">
                                <i class="fa fa-eye"></i> Lihat
                            </a>
                            <a href="{{ asset('storage/' . $item->file) }}" download class="btn btn-sm btn-success">
                                <i class="fa fa-download"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Dokumen belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection
