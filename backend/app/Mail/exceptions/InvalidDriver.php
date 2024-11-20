<?php

namespace MythicalClient\Mail\exceptions;

class InvalidDriver extends \Exception
{

    protected $message = 'Invalid Driver used for sending emails.';
    protected $code = 69200;
    protected $previous;
}