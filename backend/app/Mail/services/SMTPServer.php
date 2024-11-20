<?php

namespace MythicalClient\Mail\services;

use MythicalClient\App;
use MythicalClient\Chat\Database;
use MythicalClient\Config\ConfigFactory;
use MythicalClient\Config\ConfigInterface;

class SMTPServer
{
    public static function send(string $to, string $subject, string $body)
    {
        $config = new ConfigFactory(Database::getPdoConnection());

        if ($config->getSetting(ConfigInterface::SMTP_ENABLED, "false") == "true") {
            if (
                $config->getSetting(ConfigInterface::SMTP_HOST, null) == null || 
                $config->getSetting(ConfigInterface::SMTP_PORT, null) == null ||
                $config->getSetting(ConfigInterface::SMTP_USER, null) == null ||
                $config->getSetting(ConfigInterface::SMTP_PASS, null) == null || 
                $config->getSetting(ConfigInterface::SMTP_FROM, null) == null 
            ) {
                App::getInstance(true)->getLogger()->info("Failed to send email, SMTP settings are not configured.");
                return;
            }
            $mail = new \PHPMailer\PHPMailer\PHPMailer(false);
            try {
                $mail->isSMTP();
                $mail->Host = $config->getSetting(ConfigInterface::SMTP_HOST, null);
                $mail->SMTPAuth = true;
                $mail->Username = $config->getSetting(ConfigInterface::SMTP_USER, null);
                $mail->Password = $config->getSetting(ConfigInterface::SMTP_PASS, null);
                $mail->SMTPSecure = $config->getSetting(ConfigInterface::SMTP_ENCRYPTION, "ssl");
                $mail->Port = $config->getSetting(ConfigInterface::SMTP_PORT, null);
                $mail->setFrom($config->getSetting(ConfigInterface::SMTP_FROM, null));
                $mail->addReplyTo($config->getSetting(ConfigInterface::SMTP_FROM, null), $config->getSetting(ConfigInterface::APP_NAME, null));
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->addAddress($to);
                $mail->send();
            } catch (\Exception $e) {
                App::getInstance(true)->getLogger()->error("Failed to send email: ".$e->getMessage());
                return;
            }

        } else {
            // No exception handling!!
        }
    }
}