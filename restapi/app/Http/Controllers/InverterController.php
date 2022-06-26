<?php

namespace App\Http\Controllers;

use App\Models\Inverters;
use App\Models\Panels;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InverterController extends Controller
{
    function __construct() {
        $this->object = "inverters";
    }

    /**
     * @throws ValidationException
     */
    public function quote(Request $request): Collection|JsonResponse
    {
        if ($request->get('token') && $this->validate($request->get('token'))) {
            if ($this->tokenValidation($request->get('token'))) {
                if ($request->get('inverter_wattage') && $this->validate($request->get('inverter_wattage'))) {
                    $inverterWattage = $request->get('inverter_wattage');
                    ($request->get('panel_wattage')) ? $panelWattage = $request->get('panel_wattage') : $panelWattage = null;
                    $inverterModel = new Inverters();
                    $inverter = $inverterModel->getInverterForWattage($inverterWattage);
                    $panelModel = new Panels();
                    $panel = $panelModel->getPanelForWattage($panelWattage);
                    $totalPrice = $this->calculateTotalPrice($inverter->first(), $panel->first());
                    return response()->json([
                        "result" =>
                            [
                                "inverter" => $inverter->first(),
                                "panel" => $panel->first(),
                                "quote" => ["price" => $totalPrice]
                            ]
                    ]);
                } else {
                    return response()->json(['message' => 'Invalid wattage'], 401);
                }
            } else {
                return response()->json(['message' => 'Invalid token'], 401);
            }
        }
        return response()->json(['message' => 'Token missing'], 401);
    }

    /**
     * @param $inverter
     * @param $panel
     * @return int
     */
    private function calculateTotalPrice($inverter, $panel): int
    {
        return ((integer)($inverter->wattage / $panel->wattage) * $panel->price) + $inverter->price;
    }

}
