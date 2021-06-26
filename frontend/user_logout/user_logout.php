<?php
session_start();
session_destroy();
header ("Location: ../../backend/login/login.php");