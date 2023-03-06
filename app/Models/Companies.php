<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'companies_rank',
        'companies_name',
        'revenues_usd',
        'headquarters'
    ];
}
