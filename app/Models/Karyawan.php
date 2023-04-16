<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';
	protected $primaryKey = 'id';
	protected $fillable = ['departemen_id', 'nama', 'noKTP', 'telp', 'kota_tinggal', 'tanggal_lahir', 'tanggal_masuk', 'kota_penempatan'];
    
    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id', 'id');
    }
}
