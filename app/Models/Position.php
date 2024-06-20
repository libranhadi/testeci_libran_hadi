<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jabatan';
    protected $primaryKey = 'id_jabatan';

    
    protected $fillable = [
        'nama_jabatan',
        'id_level'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }

}
