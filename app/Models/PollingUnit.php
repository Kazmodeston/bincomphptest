<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnnouncedPullingResult;

class PollingUnit extends Model
{
    use HasFactory;

    protected $table = "polling_unit";

    protected $fillable = [
            "polling_unit_id",
            "ward_id",
            "lga_id",
            "uniquewardid",
            "polling_unit_name"
    ];

    public $timestamps = false;

    public function pullingResults()
    {
        return $this->hasMany(AnnouncedPullingResult::class, "polling_unit_uniqueid", "uniqueid")->sum("party_score");
    }

}
