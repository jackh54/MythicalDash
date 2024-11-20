<?php

namespace MythicalClient\Chat\columns;

class EmailVerificationColumns {
    public string $code = "code";
    public string $user = "user";
    public array $type = ["password","verify"]; 

    public static function getColumns() : array {
        return [
            "code" => "code",
            "user" => "user",
            "type" => ["password","verify"]
        ];
    }
}