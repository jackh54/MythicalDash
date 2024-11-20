<?php

namespace MythicalClient\Mail\templates;

use MythicalClient\App;
use MythicalClient\Chat\columns\UserColumns;
use MythicalClient\Chat\Database;
use MythicalClient\Chat\User;
use MythicalClient\Config\ConfigFactory;
use MythicalClient\Config\ConfigInterface;
use MythicalClient\Mail\Mail;

class Verify extends Mail
{

    public static function sendMail(string $uuid, string $verifyToken): void
    {
        try {
            $template = self::getFinalTemplate($uuid);
            $template = str_replace('${token}', $verifyToken, $template);
            $email = User::getInfo(User::getTokenFromUUID($uuid), UserColumns::EMAIL, false);
            self::send($email, 'Verify your email', $template);
        } catch (\Exception $e) {
            App::getInstance(true)->getLogger()->error("Failed to send email: " . $e->getMessage());
        }
    }

    private static function getFinalTemplate(string $uuid): string
    {
        return self::processTemplate(self::getTemplate(), $uuid);
    }

    private static function getTemplate(): string
    {
        $conn = Database::getPdoConnection();

        $query = $conn->prepare("SELECT template FROM mythicalclient_mail_templates WHERE name = :name");
        $query->execute(['name' => 'verify']);
        $template = $query->fetchColumn();
        return $template;
    }

    private static function processTemplate(string $template, string $uuid): string
    {
        $template = self::getTemplate();
        $template = User::processTemplate($template, $uuid);
        $template = Mail::processEmailTemplateGlobal($template);

        return $template;
    }
}