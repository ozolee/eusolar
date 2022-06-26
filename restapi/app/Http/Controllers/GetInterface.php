<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface GetInterface
{
    function list(Request $request): Collection|JsonResponse;
}
