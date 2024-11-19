<?php

namespace MythicalDash\Chat\interfaces;

interface UserInfo {
    public const USERNAME = "username";
    public const PASSWORD = "password";
    public const EMAIL = "email";
    public const FIRST_NAME = "first_name";
    public const LAST_NAME = "last_name";
    public const AVATAR = "avatar";
    public const UUID = "uuid";
    public const ACCOUNT_TOKEN = "token";
    public const ROLE_ID = "role";
    public const FIRST_IP = "first_ip";
    public const LAST_IP = "last_ip";
    public const BANNED = "banned";
    public const VERIFIED = "verified";
    public const TWO_FA_ENABLED = "2fa_enabled";
    public const TWO_FA_KEY = "2fa_key";
    public const TWO_FA_BLOCKED = "2fa_blocked";
    public const DELETED = "deleted";
    public const LOCKED = "locked";
    public const LAST_SEEN = "last_seen";
    public const FIRST_SEEN = "first_seen";
    public const BACKGROUND = "background";
}