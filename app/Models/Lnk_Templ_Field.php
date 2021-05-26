<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lnk_Templ_Field extends Model
{
    use HasFactory;
    protected $table = 'lnk_templ_fields';
    public $timestamps = true;

    protected $casts = [
        'cost' => 'float'
    ];

    protected $fillable = [
        'template',
        'field',
        'userid'
    ];
}
