<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'tm_kecamatan';

    /**
     * Get the item associated with the model.
     */
    public function kabkot()
    {
        return $this->hasOne(KabupatenKota::class, 'id', 'kabkot_id');
    }
}
