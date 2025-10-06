<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php?message=Logout berhasil! Silakan login kembali.");
exit;
?>