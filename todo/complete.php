
<?php
session_start();
require 'apps.php'; 

if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    markCompleted($index);
}

header('Location: home.php');
exit();
?>