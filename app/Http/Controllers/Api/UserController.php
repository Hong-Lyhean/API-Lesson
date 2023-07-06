<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

    public function onStore(Request $req)
    {
        $item = [
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email,
            'gender' => $req->gender,
            'status' => 1,
            'password' => bcrypt($req->password),
            'role' => 'user',
        ];
        try {
            DB::beginTransaction();

            $data = User::create($item);

            DB::commit();
            return response()->json([
                'message' => true,
                'data' => $data,
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => false,
                'data' => null,
            ], 500);
        }
    }
}
