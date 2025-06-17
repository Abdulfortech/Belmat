<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\LocalGovernment;
use App\Models\State;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function index(Request $request)
    {
        $states = State::where('status', 'Active')->latest()->get();
        $data = $states;
        // $data = $this->userResponse($states);
        return respondWithTransformer($states, true, 200, [], "Fetched Nigerian states successfuly");
    }


    public function lgas(Request $request)
    {
        $lga = LocalGovernment::where('status', 'Active')->latest()->get();
        $data = $this->lgasResponse($lga);
        return respondWithTransformer($data, true, 200, [], "Fetched Nigerian LGA successfuly");
    }
}
