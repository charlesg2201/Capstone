<!DOCTYPE html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<html lang="en">
<?php
require_once('check_login.php');
include('head.php');
include('header.php');
include('sidebar.php');
include('connect.php');

// $sql = "select * from tbl_admin where id = '".$_SESSION["id"]."'";
// $result = $conn->query($sql);
// $row1 = mysqli_fetch_array($result);

// $sql_manage = "select * from manage_website";
// $result_manage = $conn->query($sql_manage);
// $row_manage = mysqli_fetch_array($result_manage);
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
                <div class="page-body">
                    <div class="row">
                        <?php if ($_SESSION['user'] == 'tbl_admin_user') { ?>
                        
                        <?php } else if ($_SESSION['user'] == 'patient') { ?>
                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">My Profile</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="studentdetails.php" style="color: #ffffff; font-size: 12px;">View Profile</a>
                                        <div class="small text-white"><i class="feather icon-user" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Admission Record</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="admissionrecord.php?patientid=<?php echo $_SESSION["patientid"]; ?>" style="color: #ffffff; font-size: 12px;">View</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Physical Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="physical.php" style="color: #ffffff; font-size: 12px;">Take Assessment</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                    <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Health Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="health.php" style="color: #ffffff; font-size: 12px;">Take Assessment</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>
                        
    

                            <div class="col-xl-4 col-md-6">
                                <div class="card text-white mb-8" style="background-color: #135e96;">
                                    <div class="card-body" style="font-size: 25px; font-weight: bold;">Assessment Remarks</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
                                    <a class="small stretched-link" href="assessment_remarks.php" style="color: #ffffff; font-size: 12px;">View</a>
                                        <div class="small text-white"><i class="feather icon-file-text" style="font-size: 24px;"></i></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                        // Your PHP code snippet
                                    
                            $sql = "SELECT COUNT(DISTINCT m.userid) AS record_count
                            FROM tbl_messages m
                            JOIN tbl_admin_user p ON m.userid = p.userid
                            WHERE (m.opened = 0 and sender = 'Clinic Coordinator');";

                            $qsql = mysqli_query($conn, $sql);
                            $newMessageCount = 0;         
                            while ($rs = mysqli_fetch_array($qsql)) {
                            $newMessageCount = $rs['record_count'];
                            }
    
                             ?>
            
            <div class="col-xl-4 col-md-6">
    <div class="card text-white mb-8" style="background-color: #135e96;">
        <div class="card-body" style="font-size: 25px; font-weight: bold;">Messages</div>
        <div class="card-footer d-flex align-items-center justify-content-between" style="background-color: #0a4b78;">
            <a class="small stretched-link" href="messages.php?patientid=<?php echo $_SESSION["patientid"]; ?>" style="color: #ffffff; font-size: 12px;">Inbox</a>
            <div class="d-flex align-items-center">
                <i class="feather icon-mail" style="font-size: 24px;"></i>
                <span class="badge badge-danger ml-2" id="messageNotification"><?php echo $newMessageCount ?></span>
            </div>
        </div>
    </div>
</div>

                            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
                            <script>
    
            function updateNotificationBadge() {
                const badgeElement = document.getElementById('messageNotification');
                let newMessagesCount =  parseInt(document.getElementById('messageNotification').innerHTML);
                // Update the badge content and visibility based on newMessagesCount
                
                if (newMessagesCount > 0) {
                    badgeElement.textContent = newMessagesCount;
                    $("#messageNotification").css('visibility', 'visible');
                } else {
                    $("#messageNotification").css('visibility', 'hidden');
                }
            }

    // Call the function to update the badge when the page loads
    updateNotificationBadge();

    // Function to update the table
    function updateTable() {
        const badgeElement = document.getElementById('messageNotification');
        $.ajax({
            url: 'fetchmessage.php', // Your PHP file to fetch data
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                badgeElement.textContent = data;
                updateNotificationBadge();
                console.log(data);
            },
            error: function(error) {
                console.log('Error fetching data:', error);
            }
        });
    }

    updateTable();
    setInterval(updateTable, 1000);
</script>

    
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                        </body>
                        </html>
<?php include('footer.php'); ?>

