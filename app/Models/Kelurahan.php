<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;

    protected $table = 'tm_kelurahan';

    /**
     * Get the item associated with the model.
     */
    public function kecamatan()
    {
        return $this->hasOne(Kecamatan::class, 'id', 'kecamatan_id');
    }
}
