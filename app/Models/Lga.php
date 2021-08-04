<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnnouncedPullingResult;
use App\Models\PollingUnit;


class Lga extends Model
{
    use HasFactory;

    protected $table = "lga";

    public function getLgaPollingResult()
    {
        return $this->hasManyThrough(AnnouncedPullingResult::class, PollingUnit::class, "lga_id", "polling_unit_uniqueid", "lga_id", "polling_unit_id");
    }

    public function getPollingUnits()
    {
        return $this->hasMany(PollingUnit::class, "lga_id", "lga_id");
    }

}
