<?php
session_start();

function countUniqueIDChiTiet($cart) {
    $uniqueIDs = array();
    foreach ($cart as $item) {
        if (!in_array($item['IDChiTiet'], $uniqueIDs)) {
            $uniqueIDs[] = $item['IDChiTiet'];
        }
    }
    return count($uniqueIDs);
}

$totalUniqueIDChiTiet = 0;
if (isset($_SESSION['cart'])) {
    $totalUniqueIDChiTiet = countUniqueIDChiTiet($_SESSION['cart']);
}

echo $totalUniqueIDChiTiet;
?>