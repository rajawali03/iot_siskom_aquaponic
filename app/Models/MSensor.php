<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSensor extends Model
{
    use HasFactory;

    protected $table ='post_table_aquaponic';
    protected $primaryKey = 'id';
    protected $fillable =['sisa_makanan', 'kekeruhan_air'];
}