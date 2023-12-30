<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once('check_login.php');
    include('head.php');
    include('header.php');
    include('sidebar.php');
    include('connect.php');
    ?>
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
            <div class="page-wrapper">

<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item">
 <i class="feather icon-home"></i>
</li>
<li class="breadcrumb-item"><a href="index.php">Home</a>
</li>
<li class="breadcrumb-item"><a href="messages.php">Message</a>
</li>
</ul>
</div>
</div>
</div>
</div>
    <style>
        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        

        .inbox-container {
            width: 100%;
            height: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            overflow: auto; /* Add this to enable scrolling if content exceeds the height */
        }

        .message {
            margin-bottom: 20px;
        }

        .message .sender {
            font-weight: bold;
            color: #333;
        }

        .message .message-body {
            margin-top: 5px;
            padding: 10px;
            background-color: #e6e6e6;
            border-radius: 8px;
        }

        .message .timestamp {
            font-size: 0.8em;
            color: #999;
        }

        .compose-form {
            margin-top: 20px;
        }

        .compose-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        .compose-form button {
            display: block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .no-messages {
            text-align: center;
            color: #777;
        }
    </style>
    
    <title>Message Inbox</title>
</head>
<body>

<div class="inbox-container">
<?php
$patientid = isset($_GET['patientid']) ? $_GET['patientid'] : null;
function getPatientName($conn, $patientid) {
    $sql = "SELECT fname FROM patient WHERE patientid = '$patientid'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['fname'];
    } else {
        // Debugging information
        echo '<div class="debug-info">Debug: Unable to fetch patient name for ID ' . $patientid . '</div>';
        echo '<div class="debug-info">Debug: SQL Query: ' . $sql . '</div>';
        return 'Unknown Patient';
    }
}

// Handle form submission and message insertion
if (isset($_POST['btn_submit'])) {
    $message = $_POST['message'];

    // Hard-code the clinic coordinator as the sender
    $sender = 'Clinic Coordinator';

    // Insert the message into the database with the clinic coordinator as the sender and the patient as the receiver
    $sql = "INSERT INTO tbl_messages (patientid, message, sender, receiver) VALUES ('$patientid', '$message', '$sender', '$patientid')";

    if (mysqli_query($conn, $sql)) {
        // Display success message or redirect to messages.php
        ?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    Success
                </h3>
                <p>Message Inserted Successfully</p>
                <p>
                <?php echo "<script>setTimeout(\"location.href = 'messages.php?patientid=" . $patientid . "';\", 1500);</script>"; ?>
                </p>
            </div>
        </div>
        <?php
    } else {
        echo mysqli_error($conn);
    }
}


// Fetch and display messages from the database (in ascending order)
$sqlFetchMessages = "SELECT * FROM tbl_messages WHERE patientid = '$patientid' ORDER BY timestamp ASC";
$resultFetchMessages = mysqli_query($conn, $sqlFetchMessages);
$messages = mysqli_fetch_all($resultFetchMessages, MYSQLI_ASSOC);

// Display conversation
// Display conversation
if (empty($messages)) {
    echo '<div class="no-messages">Start a conversation with the Clinic Coordinator.</div>';
} else {
    foreach ($messages as $msg) {
        $senderName = ($msg['sender'] == 'Clinic Coordinator') ? 'Clinic Coordinator' : getPatientName($conn, $msg['patientid']);
        echo '<div class="message">';
        echo '<div class="sender">' . $senderName . '</div>';
        echo '<div class="message-body">' . $msg['message'] . '</div>';
        echo '<div class="timestamp">Sent on: ' . $msg['timestamp'] . '</div>';
        echo '</div>';
    }
    
    
    
    
}

// Function to get patient name by patientid


?>
<!-- Compose form -->
<div class="compose-form">
    <form id="main" method="post" action="" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-sm-10">
                <textarea name="message" class="form-control" rows="3" placeholder="Type your message"></textarea>
            </div>
            <div class="col-sm-2">
                <button type="submit" name="btn_submit" class="btn btn-primary m-b-0">Send</button>
            </div>
        </div>
    </form>
</div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
