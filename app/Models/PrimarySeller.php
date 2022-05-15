<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimarySeller extends Model
{
    protected $fillable = ['application_id', 'seller_id', 'deal_id'];

    use HasFactory;
}
