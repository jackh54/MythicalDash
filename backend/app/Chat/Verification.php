<?php
namespace MythicalClient\Chat;

use MythicalClient\Chat\columns\UserColumns;

class Verification extends Database {
    public CONST TABLE_NAME = "mythicalclient_users_email_verification";


    public static function add(string $code, string $uuid, string $type) : void {
        if (User::exists(UserColumns::UUID, $uuid)) {
            $conn = self::getPdoConnection();
            $query = $conn->prepare("INSERT INTO " . self::TABLE_NAME . " (code, user, type) VALUES (:code, :user, :type)");
            $query->execute(['code' => $code, 'user' => $uuid, 'type' => $type]);
        } else {
            
        }
    }

    public static function verify(string $code, string $type) : bool {
        
    }

    public static function delete(string $code) : void {
    }


}