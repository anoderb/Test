<?php
// Inisialisasi variabel
$total_belanja = 0;
$member = false;
$diskon = 0;
$harga_akhir = 0;

// Cek jika form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_belanja = $_POST['total_belanja'];
    $member = isset($_POST['member']);

    if ($member) {
        // Logika diskon untuk member
        if ($total_belanja >= 500000) {
            $diskon = 0.20;  // Diskon 20% untuk member
        } elseif ($total_belanja >= 300000) {
            $diskon = 0.15;  // Diskon 15% untuk member
        } else {
            $diskon = 0.10;  // Diskon 10% untuk member
        }
    } else {
        // Logika diskon untuk non-member
        if ($total_belanja >= 500000) {
            $diskon = 0.10;  // Diskon 10% untuk non-member
        }
    }

    // Hitung harga akhir
    $harga_akhir = $total_belanja - ($total_belanja * $diskon);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumlah Total Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            background-color: white;
            padding: 20px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="number"], input[type="submit"], input[type="checkbox"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .result {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Jumlah Total Pembelian (23.240.0026)</h1>
        <form method="post" action="">
            <label for="total_belanja">Masukkan Total Pembelian</label>
            <input type="number" name="total_belanja" id="total_belanja" required>
            <label>
                <input type="checkbox" name="member"> Apakah Anda Member?
            </label>
            <input type="submit" value="Hitung">
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="result">
                <p>Total Belanja: Rp<?= number_format($total_belanja, 0, ',', '.') ?></p>
                <p>Diskon: <?= $diskon * 100 ?>%</p>
                <p>Harga Akhir: Rp<?= number_format($harga_akhir, 0, ',', '.') ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
