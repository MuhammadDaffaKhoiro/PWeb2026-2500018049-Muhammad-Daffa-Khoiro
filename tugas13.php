<?php

function hitungNilaiAkhir($kehadiran, $tugas, $uts) {
    $nilaiAkhir = ($kehadiran * 0.2) + ($tugas * 0.4) + ($uts * 0.4);
    return $nilaiAkhir;
}

function tentukanStatusKelulusan($nilai, &$status) {
    if ($nilai >= 80) {
        $status = "LULUS (Sangat Memuaskan)";
    } elseif ($nilai >= 65) {
        $status = "LULUS (Memuaskan)";
    } elseif ($nilai >= 50) {
        $status = "LULUS (Cukup)";
    } else {
        $status = "TIDAK LULUS";
    }
}

$dataPraktikan = [
    "Ahmad Fauzi"   => [100, 85, 80],
    "Siti Rahma"    => [90, 75, 85],
    "Budi Santoso"  => [80, 60, 55],
    "Dewi Lestari"  => [95, 90, 92],
    "Eko Prasetyo"  => [70, 50, 45]
];

$nilaiAkhirMhs = [];
$statusMhs = [];

foreach ($dataPraktikan as $nama => $komponenNilai) {
    $na = hitungNilaiAkhir($komponenNilai[0], $komponenNilai[1], $komponenNilai[2]);
    $nilaiAkhirMhs[$nama] = $na;
    
    $statusString = "";
    tentukanStatusKelulusan($na, $statusString);
    $statusMhs[$nama] = $statusString;
}

arsort($nilaiAkhirMhs);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas PWeb: Array dan Fungsi PHP</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background-color: #f4f6f9; color: #333; margin: 30px; }
        .container { max-width: 800px; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin: 0 auto; }
        h2, h3 { color: #1a365d; margin-top: 0; }
        h2 { border-bottom: 2px solid #d69e2e; padding-bottom: 10px; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 20px; }
        th, td { border: 1px solid #cbd5e0; padding: 10px; text-align: left; }
        th { background-color: #2c5282; color: white; }
        tr:nth-child(even) { background-color: #f7fafc; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 9pt; font-weight: bold; }
        .badge-success { background-color: #c6f6d5; color: #22543d; }
        .badge-danger { background-color: #fed7d7; color: #742a2a; }
        .info-box { background-color: #ebf8ff; border-left: 4px solid #3182ce; padding: 12px; border-radius: 0 4px 4px 0; font-size: 10pt; }
    </style>
</head>
<body>

<div class="container">
    <h2>Sistem Perangkingan Hasil Praktikum Lab RDC</h2>
    
    <div class="info-box">
        <strong>Informasi Sistem (Fungsi Array Built-in):</strong><br>
        Total praktikan yang diproses: <?php echo count($nilaiAkhirMhs); ?> Mahasiswa.<br>
        Status Fungsi <code>hitungNilaiAkhir</code>: Terdeteksi dan <?php echo function_exists('hitungNilaiAkhir') ? "Aktif" : "Tidak Aktif"; ?>.
    </div>

    <h3>Daftar Peringkat Nilasi Kelulusan (Diurutkan via arsort)</h3>
    <table>
        <thead>
            <tr>
                <th>No / Peringkat</th>
                <th>Nama Mahasiswa</th>
                <th>Nilai Akhir (20% K + 40% T + 40% U)</th>
                <th>Status Kelulusan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($nilaiAkhirMhs as $nama => $nilai) {
                $statusPrentasi = $statusMhs[$nama];
                $isLulus = (strpos($statusPrentasi, 'TIDAK') === false);
                
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td><strong>$nama</strong></td>";
                echo "<td>$nilai</td>";
                echo "<td><span class='badge " . ($isLulus ? 'badge-success' : 'badge-danger') . "'>$statusPrentasi</span></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>