<?php

namespace MythicalClient\Mail;

use Exception;
use MythicalClient\Chat\Database;
use MythicalClient\Config\ConfigFactory;
use MythicalClient\Config\ConfigInterface;
use MythicalClient\Mail\exceptions\InvalidDriver;
use MythicalClient\Mail\services\SMTPServer;

class Mail {
    /**
     * Send an email.
     * 
     * @param string $to The email address of the recipient
     * @param string $subject The subject of the email
     * @param string $message The message of the email
     * 
     * @return void
     */
    public static function send(string $to, string $subject,string $message) : void {
        //TODO: Add more drivers
        SMTPServer::send($to, $subject, $message);
    }

    /**
     * Is the SMTP server enabled?
     * 
     * @return bool 
     */
    public static function isEnabled() : bool {
        $config = new ConfigFactory(Database::getPdoConnection());

        if ($config->getSetting(ConfigInterface::SMTP_ENABLED, "false") == "true") {
            return true;
        } else {
            return false;
        }
    }

    public static function processEmailTemplateGlobal(string $template) : string {
        $config = new ConfigFactory(Database::getPdoConnection());
        
        $template = str_replace('${app_name}', $config->getSetting(ConfigInterface::APP_NAME,"MythicalSystems"), $template);
        $template = str_replace('${app_url}', $config->getSetting(ConfigInterface::APP_URL,"localhost"), $template);
        $template = str_replace('${app_logo}', $config->getSetting(ConfigInterface::APP_LOGO,"https://github.com/mythicalltd.png"), $template);
        $template = str_replace('${app_lang}', $config->getSetting(ConfigInterface::APP_LANG,'en_US'), $template);
        $template = str_replace('${app_timezone}', $config->getSetting(ConfigInterface::APP_TIMEZONE,'UTC'), $template);
        $template = str_replace('${app_version}', $config->getSetting(ConfigInterface::APP_VERSION,'1.0.0'), $template);

        return $template;
    }

}