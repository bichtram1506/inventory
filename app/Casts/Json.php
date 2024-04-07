<?php
namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Json implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  mixed  $value
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        return json_decode($value, true);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  mixed  $value
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        return json_encode($value);
    }
}
