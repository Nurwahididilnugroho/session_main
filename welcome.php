<?php

$uname="aidil";
$pwd="123";

session_start();
if(isset($_SESSION['uname'])){
    echo "<h1>welcome " .$_SESSION['uname']. "</h1>";
    echo "<a href='product.php'>Product</a><br>";
    echo "<br><a href='logout.php'><input type=button value=logout name=logout></a>";

}
else{
    if($_POST['uname'] == $uname && $_POST['pwd'] == $pwd){
        $_SESSION['uname']=$uname;
        echo "<script>location.href='login.php'</script>";
        }
        else{
            echo "<script>alert('username or password incorrect!==)</script>";
            echo "<script>location.href='login.php'</script>";
        }
    }
 ?>


<?php
$db = new SQLite3('../quiz.sqlite');

// Ambil data siswa dari database
$result = $db->query("SELECT nama, nomor, hasil FROM data_siswa ORDER BY hasil DESC, id ASC");

$ranking = [];

// Kelompokkan siswa berdasarkan hasil
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $score = $row['hasil'];
    if (!isset($ranking[$score])) {
        $ranking[$score] = [
            'nama' => [],
            'nomor' => []
        ];
    }
    $ranking[$score]['nama'][] = $row['nama'];
    $ranking[$score]['nomor'][] = $row['nomor'];
}

// Urutkan berdasarkan skor dari yang tertinggi
ksort($ranking);
$ranking = array_reverse($ranking);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking Quiz</title>
    <style>
        body {
            font-family: 'Comic Sans MS', sans-serif;
            background-image: radial-gradient(#ebf4f6 2px, transparent 2px), radial-gradient(#ebf4f6 2px, transparent 2px);
            background-size: 61px 61px;
            background-position: 0 0, 30.5px 30.5px;
            background-color: #37b7c3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #71c9ce;
            width: 600px;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            border: 5px solid white; 
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        
        h1 {
            font-size: 32px;
            color: white;
            margin-bottom: 20px;
        }

        .ranking {
            background-color: #71c9ce;
            padding: 10px;
            border-radius: 10px;
            font-size: 18px;
            max-height: 400px;
            overflow-y: auto;
        }   

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        th, td {
            color: white;
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid white;
        }

        th {
            font-weight: bold;
            background-color: #5FA9B8;
        }

        .back-link {
            background-color: white;
            color: #37b7c3;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .back-link:hover {
            background-color: #fff;
            color: #71c9ce;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ranking Quiz</h1>
        <div class="ranking">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; // Mulai nomor dari 1
                    $startingScore = 10; // Skor mulai dari 10
                    foreach ($ranking as $score => $data): ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo htmlspecialchars(implode(', ', $data['nama'])); ?></td>
                            <td><?php echo htmlspecialchars($startingScore); ?></td>
                        </tr>
                    <?php
                        $no++; // Tambah nomor untuk setiap entri
                        $startingScore--; // Kurangi skor untuk setiap entri
                    endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="index.php" class="back-link">Kembali</a>
    </div>
</body>
</html>
