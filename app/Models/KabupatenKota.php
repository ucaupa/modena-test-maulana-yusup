<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    use HasFactory;

    protected $table = 'tm_kabupaten_kota';

    /**
     * Get the item associated with the model.
     */
    public function provinsi()
    {
        return $this->hasOne(Provinsi::class, 'id', 'provinsi_id');
    }
}
