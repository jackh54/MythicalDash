<?php

namespace MythicalDash\Api;

interface ApiBuilder
{
    /**
     * This function should handle the request and return the response.
     */
    public function handleRequest(): void;
}