<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PollingUnit extends Model
{
    protected $table = 'polling_unit';
    protected $primaryKey = 'uniqueid';
    public $timestamps = false;

    public function results()
    {
        return $this->hasMany(AnnouncedPuResults::class, 'polling_unit_uniqueid', 'uniqueid');
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class, 'lga_id', 'lga_id');
    }
}
