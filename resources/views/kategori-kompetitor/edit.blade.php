@extends('layouts.app')

@section('content')
    <h2>Edit Master Kategori</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori-kompetitor.update', $kategori->kategori_kompetitor_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 10px;">
            <label>Nama Brand:</label><br>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Inisial:</label><br>
            <input type="text" name="inisial" value="{{ old('inisial', $kategori->inisial) }}">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Keterangan:</label><br>
            <input type="text" name="keterangan" value="{{ old('keterangan', $kategori->keterangan) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Kode Warna:</label><br>
            <input type="color" name="kode_warna" value="{{ old('kode_warna', $kategori->kode_warna) }}" required>
        </div>
        
        <button type="submit" style="padding: 8px 12px; background: blue; color: white; border: none; cursor: pointer;">Update Data</button>
        <a href="{{ route('kategori-kompetitor.index') }}">Batal</a>
    </form>
@endsection