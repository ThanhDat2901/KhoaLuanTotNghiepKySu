<?php  
require 'init.php'; 

$_SESSION['selected_products'] = isset($_POST['selected_products']) ? $_POST['selected_products'] : array();
?>