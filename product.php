<?php
session_start();

if(isset($_SESSION['uname'])){
    echo "<h2>Selamat datang di perkakas kakap<h2>";
    echo "<br><a href='login.php'><input type=button name=back value=back></a>";
}
else{
    echo "<script>location.href='welcome.php'</script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database kecil-kceilan</title>
</head>
<body>
    <h3>Silahkan masukan nama anda di kolom bawah ini</h3>
    <form action="">
        <div>
            <input type="text" name="username" autocomplete="off" required>
            <label for="">Nama</label>
        </div>
        <div>
            <input type="password" name="password" autocomplete="off" required>
            <label for="">password</label>
        </div>
        <div>
            <input type="submit" value="simpan">
        </div>
    </form>
    <br>
    <br>
    <th>
        <tr><?php foreach ($username as $data)?></tr>
    </th>
</body>
</html>
<?php
extract($_REQUEST);
$simpan=fopen("form-simpan.txt", "simpan.db", "a");
fwrite($simpan, "nama   :");
fwrite($simpan, $username  ."\n");
fwrite($simpan, "password   :");
fwrite($simpan, $password  ."\n");
fclose($simpan);


?>