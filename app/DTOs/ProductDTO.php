<?php

namespace App\DTOs;

use Spatie\DataTransferObject\DataTransferObject;

class ProductDTO extends DataTransferObject
{
    public ?string $name;
    public ?int $price;
    public ?string $image;
    public ?string $description;
    public ?int $exist;
    public ?int $category_id;
}
