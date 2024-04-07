
<?php
 include('connect.php');
 

 $sql = "SELECT * FROM tbl_admin_user WHERE userid = '".$_SESSION["userid"]."'";
 $result = $conn->query($sql);
 $ro = mysqli_fetch_array($result);
 
 // Check if a profile image exists for the System Admin
 if ($_SESSION['user'] == 'tbl_admin_user') {
     $profile_sql = "SELECT profile_photo FROM tbl_admin_user WHERE userid = '".$_SESSION["userid"]."'";
     $profile_result = $conn->query($profile_sql);
 
         if (!$profile_result) {
             die("Error in SQL query: " . mysqli_error($conn));
         }
     
     $profile_data = mysqli_fetch_array($profile_result);
     $profile_image = isset($profile_data['profile_photo']) ? $profile_data['profile_photo'] : 'default_image.jpg';
     
 }

 ?>
  <style>
        .notification-badge {
            position: relative;
        }

        .badge {
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 5px 8px;
        }
    </style>
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar" >
            <div class="d-flex justify-content-center align-items-center" style="background-color: #0a4b78 ; height: 150px;">
                <div style="width: 130px; height: 130px; overflow: hidden; border-radius: 50%;">
                    <img class="profile-img" src="<?php echo $profile_image ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" alt="Profile Image">
                </div>
            </div>

<div class="pcoded-inner-navbar main-menu" style="background-color: #0a4b78 ">
    
  <?php if(($_SESSION['user'] == 'tbl_admin_user')){ ?>
<div style="text-align: center; color: white" >Clinic Coordinator</div>
<?php } ?>
<ul class="pcoded-item pcoded-left-item">
<li class="">
<a href="index.php">
<span class="pcoded-micon"><i class="feather icon-home"></i></span>
<span class="pcoded-mtext">Dashboard</span>
</a>
</li>
<?php if($_SESSION['user'] == 'admin') { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
        <span class="pcoded-mtext">Users</span>
    </a>
    <ul class="pcoded-submenu">

        <li class="">
            <a href="users.php">
                <span class="pcoded-mtext">Add Users</span>
            </a>
        </li>

        <li class="">
            <a href="view-user.php">
                <span class="pcoded-mtext">User Logs</span>
            </a>
        </li>

        
    </ul>
    <?php }?>
</li>
<?php if(($_SESSION['user'] == 'admin') || ($_SESSION['user'] == 'tbl_admin_user')) { ?>
<li class="pcoded-hasmenu">
    <a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
        <span class="pcoded-mtext">Student</span>
    </a>
    <ul class="pcoded-submenu">
    <?php if($_SESSION['user'] == 'tbl_admin_user') { ?>
        <li class="">
            <a href="patient.php">
                <span class="pcoded-mtext">Add Student</span>
            </a>
        </li>
    <?php } ?>
        <li class="">
            <a href="view-patient.php">
                <span class="pcoded-mtext">Student Record</span>
            </a>
        </li>
    </ul>
</li>




        

<li class="pcoded-hasmenu">
<a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
        <span class="pcoded-mtext">Physical Assessment</span>
    </a>
    <ul class="pcoded-submenu">
        <li class="">
            <a href="manage_physical.php">
                <span class="pcoded-mtext">Manage Assessment</span>
            </a>
        </li>
        
        <li class="">
            <a href="physical_result.php">
                <span class="pcoded-mtext">Assessment Results</span>
            </a>
        </li>
    </ul>
</li>

<li class="pcoded-hasmenu">
<a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
        <span class="pcoded-mtext">Health Assessment</span>
    </a>
    <ul class="pcoded-submenu">
        <li class="">
            <a href="manage_health.php">
                <span class="pcoded-mtext">Manage Assessment</span>
            </a>
        </li>
        
        <li class="">
            <a href="health_result.php">
                <span class="pcoded-mtext">Assessment Results</span>
            </a>
        </li>
    </ul>
</li>

<li class="pcoded-hasmenu">
<a href="javascript:void(0)">
        <span class="pcoded-micon"><i class="feather icon-printer"></i></span>
        <span class="pcoded-mtext">Print Report</span>
    </a>
    <ul class="pcoded-submenu">
        <li class="">
            <a href="studentlist.php">
                <span class="pcoded-mtext">Student List</span>
            </a>
        </li>
        <li class="">
        <a href="admissionrecord.php?delete_status=0">
                <span class="pcoded-mtext">Admission Record</span>
            </a>
        </li>
        
        
    </ul>
</li>
<?php

$sql = "SELECT COUNT(DISTINCT m.patientid) AS record_count
FROM tbl_messages m
JOIN patient p ON m.patientid = p.patientid
WHERE (m.opened = 0 and m.userid = 0);";

$qsql = mysqli_query($conn, $sql);
$newMessageCount = 0;         
while ($rs = mysqli_fetch_array($qsql)) {
$newMessageCount = $rs['record_count'];
}

?>
<li class="pcoded-hasmenu notification-badge">
        <a href="inbox.php">
            <span class="pcoded-micon"><i class="feather icon-mail"></i></span>
            <span class="pcoded-mtext">Inbox</span>
            <span class="badge" id="messageNotification"><?php echo $newMessageCount ?></span>
        </a>
    </li>
</ul>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
    // Assuming you have a variable to track the number of new messages
     // You can set this dynamically based on your actual data
     
    // Function to update the notification badge
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


</ul>
</div>

</nav>