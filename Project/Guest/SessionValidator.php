<?php
session_start();
if(!isset($_SESSION['did'])){
    header("location:../Guest/Login.php");
}
?>