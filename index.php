<?php
require_once 'Barang.php';
require_once 'BarangManager.php';

$barangManager = new BarangManager();

// Menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (float)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $barangManager->tambahBarang($nama, $harga, $stok);
    header('Location: index.php'); // Redirect untuk mencegah resubmission
    exit;
}

// Menangani penghapusan barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $barangManager->hapusBarang($id);
    header('Location: index.php'); // Redirect setelah menghapus
    exit;
}

// Membaca data barang dari file JSON
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
    <title>Manajemen Barang</title>
    <link rel="stylesheet" href="style.css"> <!-- Ganti dengan file CSS Anda jika ada -->
</head>
<link rel="stylesheet" href="style.css">
<body>
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

    <h1>Manajemen Barang</h1>

    <!-- Form tambah barang -->
    <h2>Tambah Barang</h2>
    <form action="" method="POST">
        <label for="nama">Nama Barang:</label>
        <input type="text" id="nama" name="nama" required>
        <br>
        <label for="harga">Harga Barang:</label>
        <input type="number" id="harga" name="harga" step="0.01" required>
        <br>
        <label for="stok">Stok Barang:</label>
        <input type="number" id="stok" name="stok" required>
        <br>
        <button type="submit" name="tambah">Tambah Barang</button>
    </form>

    <!-- Daftar Barang -->
    <h2>Daftar Barang</h2>
    <table border="1">
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
            <?php foreach ($daftarBarang as $barang): ?>
                <tr>
                    <td><?php echo $barang['id']; ?></td>
                    <td><?php echo $barang['nama']; ?></td>
                    <td><?php echo number_format($barang['harga'], 2, ',', '.'); ?></td>
                    <td><?php echo $barang['stok']; ?></td>
                    <td>
                        <a href="?hapus=<?php echo $barang['id']; ?>">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
