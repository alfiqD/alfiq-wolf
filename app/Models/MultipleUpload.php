<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleUpload extends Model
{
    use HasFactory;

    protected $table = 'multipleuploads'; // nama tabel sesuai database
    protected $fillable = ['filename', 'ref_table', 'ref_id'];
}
