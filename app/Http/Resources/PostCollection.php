<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                ];
            }),
            'links' => [
                'self' => 'link-value',
            ],
            'meta' => [
                'key' => 'value',
            ],
        ];
    }
}
