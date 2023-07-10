<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class AuthDTO extends DataTransferObject
{
    public ?string $name;
    public ?string $email;
    public ?string $password;
}
