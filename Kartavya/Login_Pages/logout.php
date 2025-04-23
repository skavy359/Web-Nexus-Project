<?php

session_start();
session_unset();
session_destroy();
header("Location: /Web-Nexus-Project/Kavy/Home/Home-Page.php");
exit();

?>