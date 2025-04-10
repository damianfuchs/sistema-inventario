<?php
session_start();
session_destroy();
header("Location: ../login.php");// O donde esté tu login
exit;
