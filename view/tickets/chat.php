<?php
include(__DIR__ . '/../requirements/page.php');

if (isset($_GET['ticketuuid']) && $_GET['ticketuuid'] !== "") {
    $ticketquery_db = "SELECT * FROM mythicaldash_tickets WHERE ticketuuid = ?";
    $stmt = mysqli_prepare($conn, $ticketquery_db);

    if (!$stmt) {
        header('location: /help-center/tickets?e=Prepare failed: ' . mysqli_error($conn));
        die('Prepare failed: ' . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $_GET['ticketuuid']);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_error($stmt)) {
        header('location: /help-center/tickets?e=Execute failed: ' . mysqli_stmt_error($stmt));
        die('Execute failed: ' . mysqli_stmt_error($stmt));
    }

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $ticket_db = mysqli_fetch_assoc($result);
    } else {
        header('location: /help-center/tickets?e=We can\'t find this ticket in the database');
        die();
    }

    mysqli_stmt_close($stmt);
} else {
    header('location: /help-center/tickets?e=We can\'t find this ticket in the database');
    die();
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-semi-dark"
    data-assets-path="<?= $appURL ?>/assets/" data-template="vertical-menu-template">

<head>
    <?php include(__DIR__ . '/../requirements/head.php'); ?>
    <title>
        <?= $settings['name'] ?> | Tickets
    </title>
    <link rel="stylesheet" href="../../assets/vendor/css/pages/app-chat.css" />
    <style>
        .badge.requestor-type {
            font-size: 10px;
            vertical-align: middle;
            background-color: #28a745;
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include(__DIR__ . '/../components/sidebar.php') ?>
            <div class="layout-page">
                <?php include(__DIR__ . '/../components/navbar.php') ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Help-Center / Tickets
                                /</span>
                            View</h4>
                        <?php include(__DIR__ . '/../components/alert.php') ?>
                        <?php
                        if ($ticket_db['status'] == "closed") {
                            ?>
                            <div class="row">
                                <div class="col-md-12 text-start">
                                    <a class="btn btn-primary" href="/help-center/tickets/reopen?ticketuuid=<?= $_GET['ticketuuid']?>">Reopen ticket</a>
                                    <a href="/help-center/tickets/delete?ticketuuid=<?= $_GET['ticketuuid']?>" class="btn btn-danger">Delete Ticket</a>
                                </div>
                            </div>
                            <?php
                        } else if ($ticket_db['status'] == "open") {
                            ?>
                                <div class="row">
                                    <div class="col-md-12 text-start">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#replyticket"
                                            class="btn btn-primary">Reply</button>
                                        <a href="/help-center/tickets/close?ticketuuid=<?= $_GET['ticketuuid']?>" class="btn btn-danger">Close Ticket</a>
                                    </div>
                                </div>
                            <?php
                        } else if ($ticket_db['status'] == "deleted") {
                            ?>
                                <div class="row">
                                    <div class="col-md-12 text-start">
                                        <a href="/admin/tickets" class="btn btn-danger">Exit</a>
                                    </div>
                                </div>
                            <?php
                        }
                        ?>
                        <br>
                        <div class="card ticket-reply">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6 user">
                                        <div class="d-flex align-items-center">
                                            <span class="name">
                                                System
                                                <span class="badge bg-danger requestor-type ms-2">
                                                    Administrator
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end date">
                                        <small>
                                            <?= $ticket_db['created'] ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12 message">
                                        <p>Hi, and welcome to
                                            <?= $settings['name'] ?>.<br>This is an automated message from the
                                            system to inform you that your ticket is now open.<br>Please do not spam any
                                            staff member by any chance; this will not help you get support, and please
                                            be respectful and make sure you read our terms of service and our rules.
                                            <br>If you feel like you need help quickly, make sure to join our community
                                            <a href="<?= $settings['discord_invite'] ?>"> here</a><br><br>
                                            
                                        </p>
                                        <hr>
                                        <p>
                                            Ticket Subject: <?= $ticket_db['subject']?><br>
                                            Ticket Status: <?= $ticket_db['status']?><br>
                                            Ticket Priority: <?= $ticket_db['priority']?><br>
                                            Ticket Description: <?= $ticket_db['description']?><br>
                                            Ticket Attachment: <?= $ticket_db['attachment'] ?><br>
                                            Ticket Creation Date: <?= $ticket_db['created']?>
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $ticket_id = mysqli_real_escape_string($conn, $_GET['ticketuuid']);
                        $query = "SELECT * FROM mythicaldash_tickets_messages WHERE ticketuuid='$ticket_id' ORDER BY created ASC";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $tickedusdb = $conn->query("SELECT * FROM mythicaldash_users WHERE api_key = '" . $row['userkey'] . "'")->fetch_array();

                            ?>
                            <br>
                            <div class="card ticket-reply">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-6 user">
                                            <div class="d-flex align-items-center">
                                                <span class="name">
                                                    <?= $tickedusdb['username'] ?>
                                                    <span class="badge bg-<?php if ($tickedusdb['role'] == "Administrator") {
                                                        echo 'danger';
                                                    } else {
                                                        echo 'success';
                                                    } ?> requestor-type ms-2">
                                                        <?= $tickedusdb['role'] ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end date">
                                            <small>
                                                <?= $row['created'] ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 message">
                                            <p>
                                                <?= $row['message'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                    if (!$row['attachment'] == "") {
                                        ?>
                                        <hr>
                                        <p><small>
                                                <?= $row['attachment'] ?>
                                        </small></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <?php include(__DIR__ . '/../components/footer.php') ?>
                    <div class="content-backdrop fade"></div>
                    <?php include(__DIR__ . '/../components/modals.php') ?>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>
    <?php include(__DIR__ . '/../requirements/footer.php') ?>
    <script src="<?= $appURL ?>/assets/js/app-chat.js"></script>
</body>

</html>