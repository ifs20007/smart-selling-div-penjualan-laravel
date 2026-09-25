@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 20px;">
        <h2>Daftar Cabang Agen Kompetitor</h2>
        <a href="{{ route('kompetitor.create') }}" style="padding: 8px 12px; background: blue; color: white; text-decoration: none;">Tambah Cabang Agen</a>
    </div>

    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Brand (Master)</th>
                <th>Nama Cabang</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cabang as $item)
            <tr>
                <td>{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
                <td>{{ $item->nama_kompetitor }}</td>
                <td>{{ $item->alamat }}</td>
                <td>
                    <a href="{{ route('kompetitor.edit', $item->kompetitor_id) }}">Edit</a> |
                    <form action="{{ route('kompetitor.destroy', $item->kompetitor_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus cabang ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection