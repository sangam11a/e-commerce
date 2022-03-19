<?php 
require_once "../helpers/functions.php";
session_start();
// deliverLogin();
if(isset($_SESSION['deliver'])) {
    session_destroy();
    header("location:../index.php");
    die;
}