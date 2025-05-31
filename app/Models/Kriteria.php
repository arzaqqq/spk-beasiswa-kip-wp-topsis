<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = ['kode', 'nama', 'jenis', 'bobot', 'deskripsi'];

    protected $casts = [
        'bobot' => 'decimal:3'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Validasi bobot total harus 1 saat menyimpan
            $totalBobot = Kriteria::where('id', '!=', $model->id)->sum('bobot') + $model->bobot;

            // if (abs($totalBobot - 1.000) > 0.001) { // Tolerance for floating point
            //     throw new \Exception("Total bobot semua kriteria harus tepat 1.00. Total saat ini: ".number_format($totalBobot, 3));
            // }
        });

        static::deleting(function ($model) {
            // Validasi minimal harus ada 1 kriteria
            if (Kriteria::count() <= 1) {
                throw new \Exception("Tidak bisa menghapus kriteria terakhir");
            }
        });
    }

    // public function subKriterias()
    // {
    //     return $this->hasMany(SubKriteria::class);
    // }

     public function penilaians() {
        return $this->hasMany(Penilaian::class);
    }
}
