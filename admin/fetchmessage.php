<?php

include('connect.php');

$sql = "SELECT COUNT(DISTINCT m.patientid) AS record_count
        FROM tbl_messages m
        JOIN patient p ON m.patientid = p.patientid
        WHERE m.opened = 0;";

$qsql = mysqli_query($conn, $sql);
$newMessageCount = 0;         
while ($rs = mysqli_fetch_array($qsql)) {
    $newMessageCount = $rs['record_count'];
}

echo json_encode($newMessageCount);

?>