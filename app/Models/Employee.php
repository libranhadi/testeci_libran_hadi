<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    
    protected $casts = [
        'ttl' => 'datetime',
    ];

    protected $fillable = [
        'nik',
        'nama',
        'ttl',
        'alamat',
        'id_jabatan',
        'id_dept'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class, 'id_jabatan', 'id_jabatan');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'id_dept', 'id_dept');
    }
}
