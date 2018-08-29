<?php
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=xvwa-export.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('itemcode', 'itemname', 'categ','price'));

include_once('../../config.php');
$sql = 'SELECT itemcode,itemname,categ,price from caffaine';
$stmt = $conn1->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_NUM)) fputcsv($output, $row);
?>
