<?php

namespace MythicalDash;


use MythicalDash\Database\Connect;

class Logger {
    /**
     * Log something in the database
     * 
     * @param string $title
     * @param string $text
     * @return void
     */
    public static function log(string $title, string $text) : void {
        $mysql = new Connect();
        $conn = $mysql->connectToDatabase();
        
        $stmt = $conn->prepare("INSERT INTO mythicaldash_logs (title, text) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $text);
        $stmt->execute();
        $stmt->close();
    }
}