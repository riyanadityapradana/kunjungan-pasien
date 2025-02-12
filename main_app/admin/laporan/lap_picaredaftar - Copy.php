<?php
	require_once("../../../configuration/koneksi.php");
	ob_start();
	session_start();
	
	$action = $_GET['action'] ?? ''; // Pastikan action tidak undefined
    $labels = [];
    $jumlahPasien = [];
	
	if ($action === 'tanggal') {
        $tanggal1 = $_POST['tanggalawal'] ?? '';
        $tanggal2 = $_POST['tanggalakhir'] ?? '';
    
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $sql = "SELECT COUNT(*) AS jumlah, DATE(insert_at) AS tanggal
                    FROM daftar_pasien 
                    WHERE is_verified <> '1' 
                    AND insert_at BETWEEN '$tanggal1' AND '$tanggal2' 
                    GROUP BY tanggal
                    ORDER BY tanggal ASC";
    
            $result = $mysqli2->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $labels[] = $row['tanggal'];
                    $jumlahPasien[] = (int)$row['jumlah'];
                }
            }
        }
    }
    
    $mysqli2->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSPI-LTE 3 | ADMIN IT 2</title>
    <link rel="icon" href="../../../../assets/img/mLITE.png">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../../assets/dist/css/report.css">
    <script src="../../../assets/plugins/chart.js/chart2.js"></script>
</head>
<body>
<div class="header">
        <img src="../../../assets/img/logo.JPG" alt="Logo Rumah Sakit">
        <h2>RUMAH SAKIT HUSADA BORNEO BANJARBARU</h2>
        <p>Jalan A. Yani KM.30,5 No.4, Guntung Manggis, Kec. Landasan Ulin, Kota Banjarbaru, Kalimantan Selatan 70712</p>
        <hr>
        <h4>LAPORAN KUNJUNGAN PASIEN SEMUA POLIKLINIK</h4>
    </div>
    <br>
    <div class="container">
        <div class="stats">
            <h3>PENDAFTARAN JANUARI</h3>
            <p>Jumlah Total Pendaftar: <span id="total"><?= array_sum($jumlahPasien); ?></span></p>
            <p>Rata-Rata Pendaftar Per Hari: <span id="average"><?= number_format(array_sum($jumlahPasien) / count($jumlahPasien), 2); ?></span></p>
            <p>Jumlah Pendaftar Maksimal Per Hari: <span id="max"><?= max($jumlahPasien); ?></span></p>
            <p>Jumlah Pendaftar Minimal Per Hari: <span id="min"><?= min($jumlahPasien); ?></span></p>
            <p>Jumlah Hari Layanan: <span id="days"><?= count($jumlahPasien); ?></span></p>
        </div>
        <table>
            <tr>
                <th>Tanggal Layanan</th>
                <th>Jumlah Pasien</th>
            </tr>
            <tbody id="data-table">
                <?php foreach ($labels as $index => $tanggal) : ?>
                    <tr>
                        <td><?= $tanggal; ?></td>
                        <td><?= $jumlahPasien[$index]; ?></td>
                        <tr><td colspan="2">Total: 825</td></tr>
                        <tr><td colspan="2">Rata-rata: 82,5</td></tr>
                        <tr><td colspan="2">Maksimum: 105</td></tr>
                        <tr><td colspan="2">Minimum: 60</td></tr>
                        <tr><td colspan="2">Jumlah Hari: 10</td></tr>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="chart-container">

    <canvas id="barChart"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const labels = <?= json_encode($labels); ?>;
            const data = <?= json_encode($jumlahPasien); ?>;

            const ctx = document.getElementById("barChart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Jumlah Pasien",
                        data: data,
                        backgroundColor: "rgba(54, 162, 235, 0.7)",
                        borderColor: "rgba(54, 162, 235, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    },
                    plugins: {
                        legend: { display: true },
                        tooltip: { enabled: true }
                    }
                }
            });
        });

        window.print();
    </script>

</body>
</html>
