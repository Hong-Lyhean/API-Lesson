<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::where('status', 1)->get();
        return response()->json([
            'data'  => $data,
            'message'   => true,
        ], 200);
    }
}
