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

<!-- Daftar Barang -->

<link rel="stylesheet" href="style.css">

<h2>Daftar Barang</h2>
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($daftarBarang)): ?>
            <?php foreach ($daftarBarang as $barang): ?>
                <tr>
                    <td><?php echo htmlspecialchars($barang['id']); ?></td>
                    <td><?php echo htmlspecialchars($barang['nama']); ?></td>
                    <td><?php echo number_format((float)$barang['harga'], 2, ',', '.'); ?></td>
                    <td><?php echo (int)$barang['stok']; ?></td>
                    <td>
                        <a href="?hapus=<?php echo urlencode($barang['id']); ?>" 
                           onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                           Hapus
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data barang.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
