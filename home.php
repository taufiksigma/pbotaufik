<?php
function getBarangFromJson() {
    $filePath = 'data.json';
    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        return json_decode($jsonData, true); // Mengubah JSON menjadi array
    }
    return [];
}

$daftarBarang = getBarangFromJson(); // Mendapatkan daftar barang dari JSON
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistem Barang</title>
    <link rel="stylesheet" href="style.css"> <!-- Tambahkan file CSS jika ada -->
</head>
<body>
<nav style="background-color: #6e3482; padding: 15px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-bottom: 20px;">
    <ul style="list-style-type: none; margin: 0; padding: 0; display: flex; justify-content: center; gap: 20px;">
       <li>
            <a href="home.php" style="color: #e7dbef; text-decoration: none; font-weight: bold; padding: 10px 15px; border-radius: 5px; background-color: #49225b; transition: background-color 0.3s;">
                HOME
            </a>
        </li> 
        <li>
            <a href="index.php" style="color: #e7dbef; text-decoration: none; font-weight: bold; padding: 10px 15px; border-radius: 5px; background-color: #49225b; transition: background-color 0.3s;">
                Manajemen Barang
            </a>
        </li>
        <li>
            <a href="konsumen.php" style="color: #e7dbef; text-decoration: none; font-weight: bold; padding: 10px 15px; border-radius: 5px; background-color: #49225b; transition: background-color 0.3s;">
                Daftar Barang (Konsumen)
            </a>
        </li>
        
    </ul>
</nav>

<h1>Selamat Datang di Sistem Barang</h1>
<p>Halaman ini adalah pusat informasi barang. Anda dapat mengelola barang atau melihat daftar barang sebagai konsumen melalui menu di atas.</p>

<section style="margin-top: 20px;">
    <h2>Ringkasan Barang</h2>
    <p>Total Barang: <?php echo count($daftarBarang); ?></p>
    <p>Total Stok: <?php echo array_sum(array_column($daftarBarang, 'stok')); ?></p>
    <p>Total Nilai Barang: Rp <?php 
        $totalNilai = array_reduce($daftarBarang, function ($carry, $item) {
            return $carry + ($item['harga'] * $item['stok']);
        }, 0);
        echo number_format($totalNilai, 2, ',', '.');
    ?></p>
</section>

<section style="margin-top: 20px;">
    <h2>Daftar Barang (Preview)</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($daftarBarang)): ?>
                <?php foreach (array_slice($daftarBarang, 0, 5) as $barang): // Tampilkan hanya 5 data ?>
                    <tr>
                        <td><?php echo htmlspecialchars($barang['id']); ?></td>
                        <td><?php echo htmlspecialchars($barang['nama']); ?></td>
                        <td><?php echo number_format((float)$barang['harga'], 2, ',', '.'); ?></td>
                        <td><?php echo (int)$barang['stok']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data barang.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p><a href="konsumen.php">Lihat Semua Barang</a></p>
</section>
</body>
</html>
