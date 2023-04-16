<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    protected $table = 'departemens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_dept'
    ];

    public function karyawans()
    {
        return $this->hasOne(Karyawan::class, 'departemen_id');
    }
}
