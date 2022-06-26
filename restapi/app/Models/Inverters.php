<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Inverters extends Model
{
    use HasFactory;

    public function getInverterForWattage(string $inverterWattage): Collection
    {
        $qb = $this->newBaseQueryBuilder();
        return $qb->select('brand','model','wattage','price','description')
            ->from('inverters')
            ->where('wattage','<=', $inverterWattage)
            ->orderBy('wattage', 'desc')
            ->limit(1)
            ->get();
    }

}
