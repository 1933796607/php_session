<?php
session_save_path('session');
session_start();
$_SESSION['web'] = 'jjs.com';
// print_r($_SESSION);
// ession_destroy();
var_dump(1 / mt_rand(1, 100));
