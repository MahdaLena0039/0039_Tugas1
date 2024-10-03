<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Total Pembelian</title>
</head>
<body>
    <h1>Form Pembelian</h1>
    <form method="POST" action="">
        <label for="nama_pembeli">Nama Pembeli:</label>
        <input type="text" id="nama_pembeli" name="nama_pembeli" required><br><br>

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="member">Member</option>
            <option value="bukan_member">Bukan Member</option>
        </select><br><br>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required><br><br>

        <label for="jumlah">Jumlah:</label>
        <input type="number" id="jumlah" name="jumlah" required><br><br>

        <input type="submit" value="Hitung">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //mengambil data dari form
        $nama_pembeli = $_POST['nama_pembeli'];
        $nama_barang = $_POST['nama_barang'];
        $status = $_POST['status'];
        $harga = $_POST['harga'];
        $jumlah = $_POST['jumlah'];

        //menghitung total pembelian
        $total = $harga * $jumlah;
        $diskon = 0;

        //cek status member
        if ($status === 'member') 
        {
            if ($total < 300000) 
            {
                $diskon = $total * 0.10; //diskon 10%
            } 
            elseif ($total >= 300000 && $total < 500000) 
            {
                $diskon = $total * 0.15; //diskon 10% + 5% tambahan
            } 
            elseif ($total >= 500000) 
            {
                $diskon = $total * 0.20; //diskon 10% + 10% tambahan
            }
        } 
        else 
        { 
            //bukan member
            if ($total >= 500000) 
            {
                $diskon = $total * 0.10; //diskon 10%
            }
        }

        //menghitung total setelah diskon
        $total_setelah_diskon = $total - $diskon;

        //menampilkan hasil
        echo "<h2>Hasil Pembelian</h2>";
        echo "Nama Pembeli: $nama_pembeli<br>";
        echo "Nama Barang: $nama_barang<br>";
        echo "Total Pembelian: Rp " . number_format($total, 2, ',', '.') . "<br>";
        echo "Diskon: Rp " . number_format($diskon, 2, ',', '.') . "<br>";
        echo "Total setelah Diskon: Rp " . number_format($total_setelah_diskon, 2, ',', '.') . "<br>";
    }
    ?>
</body>
</html>