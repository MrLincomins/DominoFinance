<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'mail',
        'compman',
        'investorSimulator',
        'whatCostMore',
        'finanseQuest',
        'game5',
        'game6',
    ];
}
