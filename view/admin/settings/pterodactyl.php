<?php
include(__DIR__ . '/../../requirements/page.php');
include(__DIR__ . '/../../requirements/admin.php');

if (isset($_GET['update_settings'])) {
    $pterodactyl_url = mysqli_real_escape_string($conn,$_GET['pterodactyl:url']);
    $pterodactyl_api_key = mysqli_real_escape_string($conn,$_GET['pterodactyl:api_key']);
    mysqli_query($conn, "UPDATE `mythicaldash_settings` SET `PterodactylURL` = '" . $pterodactyl_url . "' WHERE `mythicaldash_settings`.`id` = 1;");
    mysqli_query($conn, "UPDATE `mythicaldash_settings` SET `PterodactylAPIKey` = '" . $pterodactyl_api_key . "' WHERE `mythicaldash_settings`.`id` = 1;");
    header('location: /admin/settings');
    $conn->close();
    die();
} else {
    header('location: /admin/settings');
    die();
}
?>