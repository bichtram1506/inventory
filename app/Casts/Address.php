<?php

namespace App\Casts;

use App\Casts\ValueObjects\Address as AddressValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Address implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): AddressValueObject
    {
        // Trích xuất dữ liệu từ cơ sở dữ liệu và tạo đối tượng AddressValueObject
        $addressLineOne = isset($attributes['address_line_one']) ? $attributes['address_line_one'] : '';
        $addressLineTwo = isset($attributes['address_line_two']) ? $attributes['address_line_two'] : '';

        return new AddressValueObject($addressLineOne, $addressLineTwo);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): array
    {
        if (!($value instanceof AddressValueObject)) {
            throw new \InvalidArgumentException('The given value is not an AddressValueObject instance.');
        }

        return [
            'address_line_one' => $value->address_line_one,
            'address_line_two' => $value->address_line_two,
        ];
    }
}
