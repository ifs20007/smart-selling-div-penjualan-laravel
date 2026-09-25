@extends('layouts.app')

@section('content')
    <h2>Tambah Cabang Baru</h2>

    @if ($errors->any())
        <div style="color:red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kompetitor.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 10px;">
            <label>Brand Kompetitor:</label><br>
            <select name="kategori_kompetitor_id" required>
                <option value="">-- Pilih Brand --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->kategori_kompetitor_id }}" {{ old('kategori_kompetitor_id') == $kat->kategori_kompetitor_id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Nama Cabang:</label><br>
            <input type="text" name="nama_kompetitor" placeholder="Contoh: Cabang Sudirman" value="{{ old('nama_kompetitor') }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Alamat Lengkap:</label><br>
            <textarea name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Latitude:</label><br>
            <input type="text" name="latitude" placeholder="-5.1234" value="{{ old('latitude') }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Longitude:</label><br>
            <input type="text" name="longitude" placeholder="110.1234" value="{{ old('longitude') }}" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>URL Google Maps:</label><br>
            <input type="url" name="url" placeholder="https://maps.google.com/..." value="{{ old('url') }}">
        </div>
        
        <button type="submit" style="padding: 8px 12px; background: green; color: white; border: none; cursor: pointer;">Simpan Data Cabang</button>
        <a href="{{ route('kompetitor.index') }}">Batal</a>
    </form>
@endsection