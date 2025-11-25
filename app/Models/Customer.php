<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'pelanggan'; // pakai nama tabel yang sebenarnya
    protected $fillable = ['name', 'email', 'phone'];
}
