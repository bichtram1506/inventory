<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RedisController extends Controller
{
   
    public function redis(): JsonResponse
    {
        $redis = Redis::connection();
        Redis::set('name', 'BICH TRAM');
        $name = Redis::get('name');
        return response()->json(['name' => $name]);
    }
}

