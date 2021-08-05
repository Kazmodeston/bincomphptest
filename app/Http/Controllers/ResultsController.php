<?php

namespace App\Http\Controllers;

use App\Models\AnnouncedPullingResult;
use App\Models\Lga;
use App\Models\Party;
use App\Models\PollingUnit;
use App\Models\Ward;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Lga::where("lga_id","!=", 0)->get();
        $party = Party::all();
        return view("addResults", ["results" => $results, "parties" => $party]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return getHostByName(getHostName());
        $request->validate([
            'lga' => 'required|max:255|numeric',
            'ward' => 'required|numeric',
            'pullingUnit' => 'required',
            'party' => 'required',
            'score' => 'required|numeric',
            'scoreBy' => 'required',
        ]);

        $data = PollingUnit::create([
            "polling_unit_id" => rand(1,20),
            "ward_id" => $request->input('ward'),
            "lga_id" => $request->input('lga'),
            "uniquewardid" => rand(100,200),
            "polling_unit_name" => $request->input('pullingUnit')
        ]);

        if($data){
            
            $record = AnnouncedPullingResult::create([
                "polling_unit_uniqueid" => $data->id,
                "party_abbreviation" => $request->input('party'),
                "party_score" => $request->input('score'),
                "entered_by_user" => $request->input('scoreBy'),
                "date_entered" => date("Y-m-d H:i:s"),
                "user_ip_address" => getHostByName(getHostName())
            ]);

            if($record){
                return redirect('add-result')->with(['status' => 'Record saved successfully!', 'color' => 'alert-success']);
            }
            else{
                return redirect('add-result')->with(['status' => 'Unable to save record!', 'color' => 'alert-danger']);
            }
        }



    }

    public function getPullingUnits()
    {
        $results = PollingUnit::where("lga_id","!=", 0)->get();
        return view('addResults', ["results" => $results]);
    }

    public function  getWardFromLGA(Request $request)
    {
        $results = Ward::where("lga_id", $request->lga)->get();
        return $results;
    }

    
}
