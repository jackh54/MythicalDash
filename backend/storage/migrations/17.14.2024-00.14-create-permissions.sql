SET
    foreign_key_checks = 0;

CREATE TABLE
    `mythicaldash_roles_permissions` (
        `id` int (11) NOT NULL AUTO_INCREMENT,
        `role` int (11) NOT NULL DEFAULT 1,
        `permission` text NOT NULL,
        `deleted` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `locked` enum ('false', 'true') NOT NULL DEFAULT 'false',
        `date` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`),
        FOREIGN KEY (`role`) REFERENCES `mythicaldash_roles` (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

INSERT INTO
    `mythicaldash_roles_permissions` (
        `id`,
        `role`,
        `permission`,
        `deleted`,
        `locked`,
        `date`
    )
VALUES
    (
        1,
        1,
        'mythicaldash.default',
        'false',
        'false',
        '2024-07-20 06:52:48'
    ),
    (
        2,
        2,
        'mythicaldash.admin',
        'false',
        'false',
        '2024-07-20 06:52:48'
    ),
    (
        3,
        3,
        '*',
        'false',
        'false',
        '2024-09-26 22:19:15'
    );

SET
    foreign_key_checks = 1;