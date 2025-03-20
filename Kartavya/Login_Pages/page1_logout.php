<?php

session_start();
session_unset();
session_destroy();
header("Location: page1_index.php");
exit();

?>