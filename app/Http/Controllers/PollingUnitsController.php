<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PollingUnit;
use App\Models\Lga;
use App\Models\AnnouncedPullingResult;
use Illuminate\Support\Facades\DB;

class PollingUnitsController extends Controller
{
    public function index()
    {
        // $results = PollingUnit::all();
        $results = PollingUnit::where("lga_id","!=", 0)->get();
        // $results = PollingUnit::with("pullingResults")->get();
        
        // return Response(["message" => $data], 200);
        return view('home', ["results" => $results]);
    }

    public function getPullingUnits()
    {
        $results = Lga::where("lga_id","!=", 0)->get();
        return view('home', ["results" => $results]);
    }

    public function getpullingUnitResults(Request $request)
    {
        $results = AnnouncedPullingResult::where("polling_unit_uniqueid", $request->pullingID)->get();
        return $results;
    }

    public function getLgaPollingResult(Request $request)
    {
        
        $results = DB::select("SELECT SUM(DISTINCT announced_pu_results.party_score) as summed_total from polling_unit INNER JOIN announced_pu_results ON polling_unit.uniqueid = announced_pu_results.polling_unit_uniqueid where polling_unit.lga_id = $request->lga");

        return $results;
    }

    public function getAllLga()
    {
        $results = Lga::where("lga_id","!=", 0)->get();
        // return $results;
        return view('lgaPullingResult', ["results" => $results]);
    }

}
/* 
 */