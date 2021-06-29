<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acces extends Model
{
    use HasFactory;

    protected $fillable = ['LASTNAME','PASSWD','EMAIL'];
    protected $table = 'acces';
}
