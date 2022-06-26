<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Panels extends Model
{
    use HasFactory;

    public function getPanelForWattage(string|null $panelWattage): Collection
    {
        $qb = $this->newBaseQueryBuilder();
        if (isset($panelWattage) && $panelWattage != "null") {
            $qb->select('brand','model','wattage','price','description')
                ->from('panels')
                ->where('wattage','<=', $panelWattage)
                ->orderBy('wattage', 'DESC')
                ->limit(1);
        } else {
            $qb->selectRaw('brand, model, MIN(wattage) as wattage, price, description')
                ->from('panels')
                ->groupBy('brand','model','wattage','price','description');
        }
        return $qb->get();
    }
}
