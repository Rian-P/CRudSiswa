<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lembaga extends Model
{
    use HasFactory;
    protected $table = 'lembaga';
    protected $fillable = [
        'lembaga',
        
    ];
}
