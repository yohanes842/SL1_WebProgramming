<?php
    session_start();
    $errorfield = array();
    $errorbool =  false;
    $namadepan = $_POST['namadepan'];
    $namatengah = $_POST['namatengah'];
    $namabelakang = $_POST['namabelakang'];
    $tempatlahir = $_POST['tempatlahir'];
    $tgllahir = $_POST['tgllahir'];
    $nik = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $kodepos = $_POST['kodepos'];
    $warganegara = $_POST['warganegara'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $filename = $_FILES['fotoprofil']['name'];
    $tempName = $_FILES['fotoprofil']['tmp_name'];
    if(!is_dir('fotoprofil')) mkdir("fotoprofil");
    $dirTujuan = "fotoprofil/";
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if(empty($namadepan)){
        array_push($errorfield, "<span>Nama depan tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!ctype_alpha($namadepan)){
        array_push($errorfield, "<span>Nama depan hanya boleh mengandung huruf!</span><br>");
        $errorbool = true;
    }
    if(empty($namatengah)){
        array_push($errorfield, "<span>Nama tengah tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!ctype_alpha($namatengah)){
        array_push($errorfield, "<span>Nama tengah hanya boleh mengandung huruf!</span><br>");
        $errorbool = true;
    }
    if(empty($namabelakang)){
        array_push($errorfield, "<span>Nama belakang tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!ctype_alpha($namabelakang)){
        array_push($errorfield, "<span>Nama belakang hanya boleh mengandung huruf!</span><br>");
        $errorbool = true;
    }
    if(empty($tempatlahir)){
        array_push($errorfield, "<span>Tempat lahir tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!ctype_alpha($tempatlahir)){
        array_push($errorfield, "<span>Tempat lahir tidak valid (hanya boleh mengandung huruf)!</span><br>");
        $errorbool = true;
    }
    if(empty($tgllahir)){
        array_push($errorfield, "<span>Tanggal lahir tidak boleh kosong!</span><br>");
        $errorbool = true;
    }
    if(empty($nik)){
        array_push($errorfield, "<span>NIK tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!(is_numeric($nik) && (strlen($nik) == 16))){
        array_push($errorfield, "<span>NIK tidak valid (harus terdiri dari 16 digit angka)!</span><br>");
        $errorbool = true;
    }
    if(empty($warganegara)){
        array_push($errorfield, "<span>Warga negara tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!ctype_alpha($warganegara)){
        array_push($errorfield, "<span>Warga negara tidak valid (hanya boleh mengandung huruf)!</span><br>");
        $errorbool = true;
    }
    if(empty($email)){
        array_push($errorfield, "<span>Email tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!str_ends_with($email, ".com")){
        array_push($errorfield, "<span>Email tidak valid!</span><br>");
        $errorbool = true;
    }
    if(empty($nohp)){
        array_push($errorfield, "<span>No HP tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!(is_numeric($nohp) && ((strlen($nohp) == 11) || (strlen($nohp) == 12)))){
        array_push($errorfield, "<span>No HP tidak valid (harus mengandung 11 atau 12 digit angka!</span><br>");
        $errorbool = true;
    }
    if(empty($alamat)){
        array_push($errorfield, "<span>Alamat tidak boleh kosong!</span><br>");
        $errorbool = true;
    }
    if(empty($kodepos)){
        array_push($errorfield, "<span>Kode pos tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(!(is_numeric($kodepos) && strlen($kodepos) == 5 )){
        array_push($errorfield, "<span>Kode pos tidak valid (harus mengandung 5 digit angka)!</span><br>");
        $errorbool = true;
    }
    if(empty($username)){
        array_push($errorfield, "<span>Username tidak boleh kosong!</span><br>");
        $errorbool = true;
    }
    if(empty($password1)){
        array_push($errorfield, "<span>Password 1 tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(ctype_alpha($password1) || ctype_digit($password1)){
        array_push($errorfield, "<span>Password 1 harus mengandung angka dan huruf!</span><br>");
        $errorbool = true;
    }
    if(empty($password2)){
        array_push($errorfield, "<span>Password 2 tidak boleh kosong!</span><br>");
        $errorbool = true;
    }else if(ctype_alpha($password2) || ctype_digit($password2)){
        array_push($errorfield, "<span>Password 2 harus mengandung angka dan huruf!</span><br>");
        $errorbool = true;
    }else if($password1 != $password2){
        array_push($errorfield, "<span>Password tidak cocok</span><br>");
        $errorbool = true;
    }   

    $filenameSplited = explode(".", $filename);
    $extention = array_pop($filenameSplited);
    if(empty($filename)){
        array_push($errorfield, "<span>File image harus diupload!</span><br>");
        $errorbool = true;
    }else if(!in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])){
        array_push($errorfield, "<span>File image tidak valid!</span><br>");
        $errorbool = true;
    }
    if(!$errorbool){
        $upload = move_uploaded_file($tempName, $dirTujuan.$filename);
        $_SESSION['namadepanSession'] = $namadepan;
        $_SESSION['namatengahSession'] = $namatengah;
        $_SESSION['namabelakangSession'] = $namabelakang;
        $_SESSION['tempatlahirSession'] = $tempatlahir;
        $_SESSION['tgllahirSession'] = $tgllahir;
        $_SESSION['nikSession'] = $nik;
        $_SESSION['alamatSession'] = $alamat;
        $_SESSION['warganegaraSession'] = $warganegara;
        $_SESSION['emailSession'] = $email;
        $_SESSION['nohpSession'] = $nohp;
        $_SESSION['kodeposSession'] = $kodepos;
        $_SESSION['fotoprofilSrcSession'] = $dirTujuan.$filename;
        $_SESSION['usernameSession'] = $username;
        $_SESSION['password1Session'] = $password1;
        $_SESSION['password2Session'] = $password2;
        
        header("location:welcome.php");
    }else{
        echo "<div>";
        foreach($errorfield as $line){
            echo $line;
        }
        echo "</div>";
        echo "Register gagal! Pastikan semua data telah terisi dengan sesuai!</br>";
        echo "<a href='register.php'>Back to Register Page</a><br>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Process</title>
</head>
<style>
    *{
        font-family: sans-serif;
        padding: 10px;
    }
    body{
        background-color: #c2f0f7;
    }
    span{
        padding-bottom: 5px;
    }
</style>
<body>
    
</body>
</html>