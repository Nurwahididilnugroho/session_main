<?php
session_start();

if(isset($_SESSION['uname'])){
    header('location: welcome.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        table{
            margin-top: 150px;
            border: 1px solid;
            background-color:#eee;
        }

        td{
            border: 0px;
            padding: 10px;
        }

        th{
            border-bottom: 1px solid;
            background-color:#ddd;
        }
    </style>
</head>
<body>
    <form action="welcome.php" method="post">
        <table align="center">
        <tr>
            <th colspan="2"><h2 align="center"> Login </h2></th>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="uname"></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input type="text" name="pwd"></td>
        </tr>
        <tr>
            <td align="right" colspan="2"> <input type="submit" name="login" value="login"></td>
        </tr>
        </table>
    </form>
    
</body>
</html>