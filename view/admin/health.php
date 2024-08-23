<?php

use MythicalDash\SettingsManager;
use MythicalDash\Main;

include(__DIR__ . '/../requirements/page.php');
include(__DIR__ . '/../requirements/admin.php');


?>
<!DOCTYPE html>

<html lang="en" class="dark-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-semi-dark"
    data-assets-path="<?= $appURL ?>/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <?php include(__DIR__ . '/../requirements/head.php'); ?>
    <title>
        <?= SettingsManager::getSetting("name") ?> - Health
    </title>
</head>

<body>
    <!--<div id="preloader" class="discord-preloader">
      <div class="spinner"></div>
   </div>-->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include(__DIR__ . '/../components/sidebar.php') ?>
            <div class="layout-page">
                <?php include(__DIR__ . '/../components/navbar.php') ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Health</h4>
                        <?php include(__DIR__ . '/../components/alert.php') ?>

                        <?php
                        /**
                         * Parse the PHP version to x.x format.
                         *
                         * @return string
                         */
                        function parse_php_version()
                        {
                            preg_match('/^(\d+)\.(\d+)/', PHP_VERSION, $matches);

                            if (count($matches) > 2) {
                                return "{$matches[1]}.{$matches[2]}";
                            }

                            return PHP_VERSION;
                        }

                        $phpVersion = parse_php_version();
                        if ($phpVersion >= '8.1' && $phpVersion <= '8.3') {
                        ?>
                            <div class="alert alert-success " role="alert">
                                Your php version "<?= $phpVersion ?>" is supported by MythicalDash.
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger " role="alert">
                                You are using an outdated version of PHP please update.
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (is_writable(__DIR__)) {
                        ?>
                            <div class="alert alert-success " role="alert">
                                You have the right permissions for the MythicalDash directory.
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger " role="alert">
                                Please give us permission to the dashbaord directory <code>chown -R www-data:www-data /var/www/mythicaldash/*</code>.
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (Main::isHTTPS()) {
                        ?>
                            <div class="alert alert-success " role="alert">
                                You are using HTTPS for a secure connection!
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger " role="alert">
                                You are not using HTTPS!
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (file_exists(__DIR__ . '/../../public/assets/js/MythicalGuard.js')) {
                        ?>
                            <div class="alert alert-success " role="alert">
                                You are using MythicalGuard!
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger " role="alert">
                                You are not using MythicalGuard!
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (SettingsManager::getSetting("enable_anti_vpn") == "true") {
                        ?>
                            <div class="alert alert-success " role="alert">
                                You are using Anti-VPN Protection!
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger " role="alert">
                                You are not using Anti-VPN Protection!
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (SettingsManager::getSetting("enable_alting") == "true") {
                        ?>
                            <div class="alert alert-success " role="alert">
                                You are using anti alting protection!
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger " role="alert">
                                You are not using anti alting protection!
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        if (SettingsManager::getSetting("enable_turnstile") == "true") {
                        ?>
                            <div class="alert alert-success " role="alert">
                                You are using anti bot protection!
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="alert alert-danger " role="alert">
                                You are not using anti bot protection!
                            </div>
                        <?php
                        }
                        ?>
                        
                        <div class="card">
                            <h5 class="card-header">
                                Latest Error Logs
                                <!--<a href="/admin/users/new" class="btn btn-primary float-end">Create New User</a>-->
                            </h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Text</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        <?php
                                        $result = $conn->query("SELECT * FROM mythicaldash_logs LIMIT 15");
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $row['id'] . '</td>';
                                                echo '<td>' . $row['title'] . '</td>';
                                                echo '<td>' . $row['text'] . '</td>';
                                                echo '<td>' . $row['date'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No users found.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                                        <br>
                        <?php include(__DIR__ . '/../components/footer.php') ?>
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
            <div class="drag-target"></div>
        </div>
        <?php include(__DIR__ . '/../requirements/footer.php') ?>
        <script src="<?= $appURL ?>/assets/js/dashboards-ecommerce.js"></script>
</body>

</html>