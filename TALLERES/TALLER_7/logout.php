<?php

include 'config_sesion.php';
session_destroy();
header("Location: login.php");
exit();
