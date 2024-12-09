<?php
require 'index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $harga = (float)$_POST['harga'];
    $stok = (int)$_POST['stok'];

    if (!empty($nama) && $harga > 0 && $stok > 0) {
        $barangManager->tambahBarang($nama, $harga, $stok);
        header('Location: index.php');
        exit;
    }
}

if (isset($_GET['hapus'])) {
    $id = htmlspecialchars($_GET['hapus']);
    $barangManager->hapusBarang($id);
    header('Location: index.php');
    exit;
}
?>
