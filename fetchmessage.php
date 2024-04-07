<?php

include('connect.php');

$sql = "SELECT COUNT(DISTINCT m.userid) AS record_count
FROM tbl_messages m
JOIN tbl_admin_user p ON m.userid = p.userid
WHERE (m.opened = 0 and sender = 'Clinic Coordinator');";

$qsql = mysqli_query($conn, $sql);
$newMessageCount = 0;         
while ($rs = mysqli_fetch_array($qsql)) {
    $newMessageCount = $rs['record_count'];
}

echo json_encode($newMessageCount);

?>