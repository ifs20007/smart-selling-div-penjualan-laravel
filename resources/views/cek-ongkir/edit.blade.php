<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4" style="color: #003B73;">Edit Tarif Ongkir</h2>
                    
                    <form action="{{ route('data-ongkir.update', $ongkir->tarif_ongkir_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <select id="provinsi" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinsi as $p)
                                    <option value="{{ $p->provinsi_id }}" {{ $ongkir->wilayah->provinsi_id == $p->provinsi_id ? 'selected' : '' }}>
                                        {{ $p->nama_provinsi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Wilayah / Kota</label>
                            <select name="wilayah_id" id="wilayah" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($wilayah as $w)
                                    <option value="{{ $w->wilayah_id }}" {{ $ongkir->wilayah_id == $w->wilayah_id ? 'selected' : '' }}>
                                        {{ $w->nama_wilayah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kompetitor</label>
                            <select name="kategori_kompetitor_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kompetitor --</option>
                                @foreach($kompetitor as $k)
                                    <option value="{{ $k->kategori_kompetitor_id }}" {{ $ongkir->kategori_kompetitor_id == $k->kategori_kompetitor_id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Layanan</label>
                            <input type="text" name="jenis_layanan" value="{{ old('jenis_layanan', $ongkir->jenis_layanan) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Harga per Kg (Rp)</label>
                            <input type="number" name="harga_per_kg" value="{{ old('harga_per_kg', $ongkir->harga_per_kg) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Waktu</label>
                            <input type="text" name="estimasi_waktu" value="{{ old('estimasi_waktu', $ongkir->estimasi_waktu) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('data-ongkir.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded shadow hover:bg-gray-400">Batal</a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700" style="background-color: #003B73;">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('provinsi').addEventListener('change', function() {
            var provinsi_id = this.value;
            var wilayahSelect = document.getElementById('wilayah');
            
            wilayahSelect.innerHTML = '<option value="">Memuat...</option>';
            
            if(provinsi_id) {
                fetch('/api/wilayah/' + provinsi_id)
                    .then(response => response.json())
                    .then(data => {
                        wilayahSelect.innerHTML = '<option value="">-- Pilih Wilayah --</option>';
                        data.forEach(function(wilayah) {
                            var option = document.createElement('option');
                            option.value = wilayah.wilayah_id;
                            option.text = wilayah.nama_wilayah;
                            wilayahSelect.add(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                wilayahSelect.innerHTML = '<option value="">-- Pilih Provinsi Terlebih Dahulu --</option>';
            }
        });
    </script>
</x-app-layout>
