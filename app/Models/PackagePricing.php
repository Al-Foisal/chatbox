<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePricing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function getImpliceAttribute()
    {
        $value = $this->service_implice;

        if($value == 1){
            return 'Coin';
        } elseif ($value == 2){
            return 'Month';
        } elseif ($value == 3){
            return 'Year';
        }
    }
}
