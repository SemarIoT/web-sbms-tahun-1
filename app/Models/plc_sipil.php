<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class plc_sipil extends Model
{
    use HasFactory;
    protected $fillable = ['distance','forces','gayatarik','gayatekan'];
}
