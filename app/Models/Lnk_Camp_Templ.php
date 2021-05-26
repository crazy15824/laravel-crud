<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lnk_Camp_Templ extends Model
{
    use HasFactory;
    protected $table = 'lnk_camp_templs';
    public $timestamps = true;

    protected $casts = [
        'cost' => 'float'
    ];

    protected $fillable = [
        'campaign',
        'template',
        'userid'
    ];
}
