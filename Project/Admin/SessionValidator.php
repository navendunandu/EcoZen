<?php
session_start();
if(!isset($_SESSION['aid'])){
    header("location:../Guest/Login.php");
}
?>