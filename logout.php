<?php
session_start();
require 'functions.php';
// Cek Session?
if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

session_unset();
session_destroy();

header("Location: login.php");
exit;

?>