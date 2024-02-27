<?php
ob_start();
require_once("phpqrcode/qrlib.php");

QRcode::png($_GET['code']);
?>