<?php

namespace App\OpenApi\Parameters;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ParametersFactory;

class CategoryParameters extends ParametersFactory
{
    /**
     * @return Parameter[]
     */
    public function build(): array
    {
        return [

            Parameter::path()
                ->name('category')
                ->description('Parameter description')
                ->required(true)
                ->schema(Schema::integer('category')),
            Parameter::query()
                ->name('search')
                ->description('Parameter description')
                ->required(false)
                ->schema(Schema::string('search')),

        ];
    }
}
