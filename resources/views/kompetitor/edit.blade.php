@extends('layouts.app')

@section('content')
    <h2>Edit Data Cabang</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kompetitor.update', $kompetitor->kompetitor_id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 10px;">
            <label>Brand Kompetitor:</label><br>
            <select name="kategori_kompetitor_id" required>
                <option value="">-- Pilih Brand --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->kategori_kompetitor_id }}" 
                        {{ old('kategori_kompetitor_id', $kompetitor->kategori_kompetitor_id) == $kat->kategori_kompetitor_id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Nama Cabang:</label><br>
            <input type="text" name="nama_kompetitor" value="{{ old('nama_kompetitor', $kompetitor->nama_kompetitor) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Alamat Lengkap:</label><br>
            <textarea name="alamat" rows="3" required>{{ old('alamat', $kompetitor->alamat) }}</textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Latitude:</label><br>
            <input type="text" name="latitude" value="{{ old('latitude', $kompetitor->latitude) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Longitude:</label><br>
            <input type="text" name="longitude" value="{{ old('longitude', $kompetitor->longitude) }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>URL Google Maps:</label><br>
            <input type="url" name="url" value="{{ old('url', $kompetitor->url) }}">
        </div>
        
        <button type="submit" style="padding: 8px 12px; background: blue; color: white; border: none; cursor: pointer;">Update Data Cabang</button>
        <a href="{{ route('kompetitor.index') }}">Batal</a>
    </form>
@endsection