<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Click extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'campaigndepartment',
        'clicked_at',
    ];
}
