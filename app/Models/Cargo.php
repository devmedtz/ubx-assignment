<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargo';

    public $timestamps = false;

    protected $fillable = [
        'cargo_no',
        'cargo_type',
        'cargo_size',
        'weight',
        'remarks',
        'wharfage',
        'penalty',
        'storage',
        'electricity',
        'destuffing',
        'lifting',
    ];
}
