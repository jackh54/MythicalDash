SET foreign_key_checks = 0;
CREATE TABLE
    `mythicaldash_users` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `username` text NOT NULL,
        `first_name` text NOT NULL,
        `last_name` text NOT NULL,
        `email` text NOT NULL,
        `password` text NOT NULL,
        `avatar` text DEFAULT 'https://www.gravatar.com/avatar',
        `background` text NOT NULL DEFAULT 'https://cdn.mythicalsystems.xyz/background.gif',
        `uuid` text NOT NULL,
        `token` text NOT NULL,
        `role` int (11) NOT NULL DEFAULT 1,
        `first_ip` text NOT NULL,
        `last_ip` text NOT NULL,
        `banned` text DEFAULT 'NO',
        `verified` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `2fa_enabled` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `2fa_key` text DEFAULT NULL,
        `2fa_blocked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `deleted` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `locked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `last_seen` datetime NOT NULL DEFAULT current_timestamp(),
        `first_seen` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`role`) REFERENCES `mythicaldash_roles` (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE
    `mythicaldash_roles` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `name` text NOT NULL,
        `weight` int (11) NOT NULL DEFAULT 1,
        `deleted` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `locked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `date` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
    `mythicaldash_roles` (
        `id`,
        `name`,
        `weight`,
        `deleted`,
        `locked`,
        `date`
    )
VALUES
    (
        1,
        'Default',
        1,
        'false',
        'false',
        '2024-07-20 06:52:48'
    ),
    (
        2,
        'Admin',
        2,
        'false',
        'false',
        '2024-07-20 06:52:48'
    ),
    (
        3,
        'Administrator',
        3,
        'false',
        'false',
        '2024-07-20 06:52:48'
    );

CREATE TABLE
    `mythicaldash_users_mails` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `subject` text NOT NULL,
        `body` longtext NOT NULL,
        `from` text NOT NULL DEFAULT 'app@mythicalsystems.xyz',
        `user` int (11) NOT NULL,
        `read` int (11) NOT NULL DEFAULT 0,
        `deleted` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `locked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `date` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user`) REFERENCES `mythicaldash_users` (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE
    `mythicaldash_users_activities` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `user` int (11) NOT NULL,
        `description` text NOT NULL,
        `action` text NOT NULL,
        `ip_address` text NOT NULL,
        `deleted` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `locked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `date` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user`) REFERENCES `mythicaldash_users` (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE
    `mythicaldash_users_apikeys` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `name` text NOT NULL,
        `user` int (11) NOT NULL,
        `type` enum ('r', 'rw') NOT NULL DEFAULT 'r',
        `value` text NOT NULL,
        `deleted` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `locked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `date` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user`) REFERENCES `mythicaldash_users` (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

CREATE TABLE
    `mythicaldash_users_email_verification` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `code` text NOT NULL,
        `user` int (11) NOT NULL,
        `type` enum ('password', 'verify') NOT NULL DEFAULT 'verify',
        `date` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user`) REFERENCES `mythicaldash_users` (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci AUTO_INCREMENT = 2;

CREATE TABLE
    `mythicaldash_users_notifications` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `user` int (11) NOT NULL,
        `name` text NOT NULL,
        `description` text NOT NULL,
        `deleted` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `locked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `date` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`user`) REFERENCES `mythicaldash_users` (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

SET foreign_key_checks = 1;