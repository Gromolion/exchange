<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = ['buyer_id', 'seller_id', 'count', 'price'];

    public function getBuyer()
    {
        return $this->hasOne(User::class,'id', 'buyer_id')->first();
    }

    public function getSeller()
    {
        return $this->hasOne(User::class,'id', 'seller_id')->first();
    }

    public function total()
    {

    }

    use HasFactory;
}
