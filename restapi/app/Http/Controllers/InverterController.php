<?php

namespace App\Http\Controllers;

use App\Models\Inverters;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InverterController extends Controller
{
    public function list(Request $request): Collection|JsonResponse
    {
        if ($request->get('token')) {
            if (DB::table('users')->where('token', $request->get('token'))->first()) {
                return Inverters::all();
            }
            return response()->json(['message' => 'Invalid token'], 401);
        }
        return response()->json(['message' => 'Token missing'], 401);
    }
}
