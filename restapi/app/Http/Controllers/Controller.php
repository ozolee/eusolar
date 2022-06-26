<?php

namespace App\Http\Controllers;

use App\Models\Inverters;
use App\Models\Panels;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController implements GetInterface
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected string $object;

    /**
     * @throws ValidationException
     */
    public function list(Request $request): Collection|JsonResponse
    {
        if ($request->get('token') && $this->validate($request->get('token'))) {
            if ($this->tokenValidation($request->get('token'))) {
                return match ($this->object) {
                    'inverters' => Inverters::all(),
                    'panels' => Panels::all(),
                    default => response()->json(['message' => 'Invalid endpoint'], 401),
                };
            }
            return response()->json(['message' => 'Invalid token'], 401);
        }
        return response()->json(['message' => 'Token missing'], 401);
    }

    protected function tokenValidation(string $token): object|null
    {
        return (DB::table('users')->where('token', $token)->first());
    }

    protected function validate(string $value): bool
    {
        return (is_string($value) && ($value != "null"));
    }
}
