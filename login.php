<?php
$u = $_POST['txtUsername'];
$p = $_POST['txtPassword'];
$db = mysqli_connect("localhost","root","","webnangcao");
$sql = "SELECT * FROM register WHERE username='$u' and password='$p'";
$rs = mysqli_query($db,$sql);
if(mysqli_num_rows($rs)>0){
    echo"<h1>Dang nhap thanh cong </h1>";
} else {
    echo"<h2>that bai</h2>";
    require_once 'login.html';
}


?>