<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        "nama" => $_POST['nama'],
        "tanggal" => $_POST['tanggal'],
        "jamMasuk" => $_POST['jamMasuk'],
        "jamPulang" => $_POST['jamPulang'],
        "keterangan" => $_POST['keterangan']
    ];

    $url = "https://script.google.com/macros/s/AKfycbza5ZscgS5RX35GDxqdCnBzoI7BS9msb1bJBwR2YF19LBQ8RyLyfvLeg5MMAaX2cerC/exec"; // ganti dengan URL Google Script

    $options = [
        "http" => [
            "header"  => "Content-type: application/json\r\n",
            "method"  => "POST",
            "content" => json_encode($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo "<p style='color:red'>❌ Gagal menyimpan data!</p>";
    } else {
        echo "<p style='color:green'>✅ Absen berhasil disimpan!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Absensi Karyawan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 400px; margin: auto; }
        input, select, button { width: 100%; padding: 10px; margin: 5px 0; }
        button { background: green; color: white; border: none; cursor: pointer; }
        button:hover { background: darkgreen; }
    </style>
</head>
<body>
    <h2>📋 Form Absensi</h2>
    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Karyawan" required>
        <input type="date" name="tanggal" required>
        <input type="time" name="jamMasuk" required>
        <input type="time" name="jamPulang">
        <select name="keterangan" required>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="WFH">WFH</option>
            <option value="Lembur">Lembur</option>
        </select>
        <button type="submit">Simpan Absen</button>
    </form>
</body>
</html>
