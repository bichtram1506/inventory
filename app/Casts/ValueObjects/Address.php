<?php

namespace App\Casts\ValueObjects;

class Address
{
    public $address_line_one;
    public $address_line_two;

    public function __construct($addressLineOne, $addressLineTwo)
    {
        $this->address_line_one = $addressLineOne;
        $this->address_line_two = $addressLineTwo;
    }
}
