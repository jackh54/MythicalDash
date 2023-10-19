<?php
if ($settings['enable_discord_link'] == "true") {
    if (isset($_GET['code'])) {
        $tokenUrl = 'https://discord.com/api/oauth2/token';
        $data = array(
            'client_id' => $settings["discord_clientid"],
            'client_secret' => $settings["discord_clientsecret"],
            'grant_type' => 'authorization_code',
            'code' => $_GET['code'],
            'redirect_uri' => $appURL . '/auth/discord',
            'scope' => 'identify guilds email guilds.join'
        );
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $result = file_get_contents($tokenUrl, false, $context);

        $accessToken = json_decode($result, true)['access_token'];

        $userUrl = 'https://discord.com/api/users/@me';

        $options = array(
            'http' => array(
                'header' => "Authorization: Bearer $accessToken\r\n",
                'method' => 'GET',
            ),
        );
        $context = stream_context_create($options);
        $result = file_get_contents($userUrl, false, $context);

        $userInfo = json_decode($result, true);
        if (isset($userInfo)) {
            $discord_email = $userInfo['email'];
            $discord_id = $userInfo['id'];
            $query = "SELECT * FROM mythicaldash_users WHERE discord_id = '$discord_id'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $token = $row['api_key'];
                    $email = $row['email'];
                    $banned = $row['banned'];
                    if (!$banned == "") {
                        header('location: /auth/login?e=We are sorry but you are banned from using our system!');
                        die();
                    } else {
                        $usr_id = $row['api_key'];
                        if ($ip_address == "127.0.0.1") {
                            $ip_address = "12.34.56.78";
                        }
                        $url = "http://ipinfo.io/$ip_address/json";
                        $data = json_decode(file_get_contents($url), true);

                        if (isset($data['error']) || $data['org'] == "AS1221 Telstra Pty Ltd") {
                            header('location: /auth/login?e=Hmmm it looks like you are trying to abuse. You are trying to use a VPN, which is not allowed.');
                            die();
                        }
                        $userids = array();
                        $loginlogs = mysqli_query($conn, "SELECT * FROM mythicaldash_login_logs WHERE userkey = '$usr_id'");
                        foreach ($loginlogs as $login) {
                            $ip = $login['ipaddr'];
                            if ($ip == "12.34.56.78") {
                                continue;
                            }
                            $saio = mysqli_query($conn, "SELECT * FROM mythicaldash_login_logs WHERE ipaddr = '" . $ip . "'");
                            foreach ($saio as $hello) {
                                if (in_array($hello['userkey'], $userids)) {
                                    continue;
                                }
                                if ($hello['userkey'] == $usr_id) {
                                    continue;
                                }
                                array_push($userids, $hello['userkey']);
                            }
                        }
                        if (count($userids) !== 0) {
                            header('location: /auth/login?e=Using multiple accounts is really sad when using free services!');
                            die();
                        }
                        $conn->query("INSERT INTO mythicaldash_login_logs (ipaddr, userkey) VALUES ('" . $ip_address . "', '$usr_id')");

                        $cookie_name = 'token';
                        $cookie_value = $token;
                        setcookie($cookie_name, $cookie_value, time() + (10 * 365 * 24 * 60 * 60), '/');
                        $conn->query("UPDATE `mythicaldash_users` SET `last_ip` = '" . $ip_address . "' WHERE `mythicaldash_users`.`api_key` = '" . $usr_id . "';");
                        header('location: /dashboard');
                    }
                } else {
                    header('location: /auth/login?e=No accounts were found under this discord account.');
                    $conn->close();
                    die();
                }
            } else {
                header('location: /auth/login?e=No accounts were found under this discord account.');
                $conn->close();
                die();
            }
            $conn->close();

        } else {
            header('location: /auth/discord');
        }
    } else {
        $authorizeUrl = 'https://discord.com/api/oauth2/authorize?client_id=' . $settings["discord_clientid"] . '&redirect_uri=' . urlencode($appURL . '/auth/discord') . '&response_type=code&scope=' . urlencode('identify guilds email guilds.join');
        header('Location: ' . $authorizeUrl);
    }
} else {
    header("location: /dashboard?e=We are sorry but we don't provide support for discord link right now");
    die();
}

?>