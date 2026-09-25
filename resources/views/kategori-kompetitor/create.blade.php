@extends('layouts.app')

@section('content')
    <h2>Tambah Master Kategori</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kategori-kompetitor.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 10px;">
            <label>Nama Brand:</label><br>
            <input type="text" name="nama_kategori" placeholder="Nama Brand" value="{{ old('nama_kategori') }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Inisial:</label><br>
            <input type="text" name="inisial" placeholder="Inisial" value="{{ old('inisial') }}">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Keterangan:</label><br>
            <input type="text" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Kode Warna:</label><br>
            <input type="color" name="kode_warna" value="{{ old('kode_warna', '#000000') }}" required>
        </div>
        
        <button type="submit" style="padding: 8px 12px; background: green; color: white; border: none; cursor: pointer;">Simpan Data</button>
        <a href="{{ route('kategori-kompetitor.index') }}">Batal</a>
    </form>
@endsection