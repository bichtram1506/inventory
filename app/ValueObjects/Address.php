<?php
namespace App\ValueObjects;

class Address
{
    public string $lineOne;
    public string $lineTwo;

    public function __construct(string $lineOne, string $lineTwo)
    {
        $this->lineOne = $lineOne;
        $this->lineTwo = $lineTwo;
    }
}
