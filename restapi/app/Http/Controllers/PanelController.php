<?php

namespace App\Http\Controllers;

use App\Models\Panels;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    function __construct() {
        $this->object = "panels";
    }
}
