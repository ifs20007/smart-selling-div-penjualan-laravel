@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 20px;">
        <h2>Daftar Kategori Kompetitor</h2>
        <a href="{{ route('kategori-kompetitor.create') }}" style="padding: 8px 12px; background: blue; color: white; text-decoration: none;">Tambah Master Kategori</a>
    </div>

    @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Nama Brand</th>
                <th>Inisial</th>
                <th>Keterangan</th>
                <th>Warna</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $item)
            <tr>
                <td>{{ $item->nama_kategori }}</td>
                <td>{{ $item->inisial }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <span style="background-color: {{ $item->kode_warna }}; padding: 5px 10px; color: white;">{{ $item->kode_warna }}</span>
                </td>
                <td>
                    <a href="{{ route('kategori-kompetitor.edit', $item->kategori_kompetitor_id) }}">Edit</a> |
                    <form action="{{ route('kategori-kompetitor.destroy', $item->kategori_kompetitor_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus master ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection