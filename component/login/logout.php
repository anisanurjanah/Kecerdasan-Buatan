<?php
session_start();
require '../functions.php';

$_SESSION = [];

session_unset();
session_destroy();

removeLoginCookie();

header("Location: ../../index.php");
exit;
