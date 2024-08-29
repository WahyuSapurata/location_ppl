<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'uuid',
        'mobile',
        'web',
        'desain',
        'jaringan',
        'nama_mahasiswa',
    ];

    protected static function boot()
    {
        parent::boot();

        // Event listener untuk membuat UUID sebelum menyimpan
        static::creating(function ($model) {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
