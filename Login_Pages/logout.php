<?php

session_start();
session_unset();
session_destroy();
header("Location: /Web-Nexus-Project/Home/Home-Page.php");
exit();

?>