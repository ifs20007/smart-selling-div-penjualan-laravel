<?php
$filename = "Database_Prospek_Pos_Pematangsiantar_" . date('Ymd') . ".xls";
header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th colspan="9" style="font-size: 16px; background-color: #f39c12; color: #fff;">
                    DATABASE KEMITRAAN & PROSPEK - POS INDONESIA PEMATANGSIANTAR
                </th>
            </tr>
            <tr style="background-color: #34495e; color: #ffffff;">
                <th>No</th>
                <th>Kategori Bisnis</th>
                <th>Nama Toko / Instansi</th>
                <th>Nama Pemilik (PIC)</th>
                <th>Alamat Lengkap</th>
                <th>Nomor WhatsApp</th>
                <th>Status Kemitraan</th>
                <th>Pegawai Pendata</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tokos as $toko)
                @php
                    $bg_color = "";
                    if($toko->status_kemitraan == 'Pelanggan Aktif') $bg_color = "background-color:#d5f5e3;"; // Hijau
                    if($toko->status_kemitraan == 'Mantan Pelanggan') $bg_color = "background-color:#fadbd8;"; // Merah
                @endphp
                <tr style='{{ $bg_color }}'>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $toko->kategoriToko->nama_kategori ?? '-' }}</td>
                    <td>{{ $toko->nama_toko }}</td>
                    <td>{{ $toko->nama_pemilik }}</td>
                    <td>{{ $toko->alamat_toko }}</td>
                    <td>'{{ $toko->nomor_whatsapp }}</td>
                    <td>{{ $toko->status_kemitraan }}</td>
                    <td>{{ $toko->user->name ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan='8'>Belum ada data terekam di sistem.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
