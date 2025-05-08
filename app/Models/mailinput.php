<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mailinput extends Model
{
    /** @use HasFactory<\Database\Factories\MailinputFactory> */
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'campaigndepartment',
        'clicked_at',
    ];
}