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
// Handle form submission and message insertion
if (isset($_POST['btn_submit'])) {
    $message = $_POST['message'];

    // Fetch all users from tbl_admin_user
    $sqlFetchUsers = "SELECT username FROM tbl_admin_user";
    $resultFetchUsers = mysqli_query($conn, $sqlFetchUsers);

    // Check if users were fetched successfully
    if ($resultFetchUsers) {
        $receivers = array();

        // Collect all receivers
        while ($userRow = mysqli_fetch_assoc($resultFetchUsers)) {
            $receivers[] = $userRow['username'];
        }

        // Convert receivers array to a comma-separated string
        $receiversString = implode(",", $receivers);

        // Insert the message into the database for all receivers
        $sql = "INSERT INTO tbl_messages (patientid, message, sender, receiver) VALUES ('$patientid', '$message', 'You', '$receiversString')";

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
                        <?php echo "<script>setTimeout(\"location.href = 'messages.php';\",1500);</script>"; ?>
                    </p>
                </div>
            </div>
            <?php
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo mysqli_error($conn);
    }
}

// Fetch and display messages from the database (in ascending order)
$sqlFetchMessages = "SELECT * FROM tbl_messages ORDER BY timestamp ASC";
$resultFetchMessages = mysqli_query($conn, $sqlFetchMessages);
$messages = mysqli_fetch_all($resultFetchMessages, MYSQLI_ASSOC);

// Display conversation
if (empty($messages)) {
    echo '<div class="no-messages">Start a conversation with the Clinic Coordinator.</div>';
} else {
    foreach ($messages as $msg) {
        echo '<div class="message">';
        echo '<div class="sender">' . ($msg['sender'] == 'You' ? 'You' : 'Other Person') . '</div>';
        echo '<div class="message-body">' . $msg['message'] . '</div>';
        echo '<div class="timestamp">Sent on: ' . $msg['timestamp'] . '</div>';
        echo '</div>';
    }
}
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
