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

    public function state(Request $request, $id)
    {
        $state = State::find($id);

        if (!$state) {
            return respondWithTransformer([], true, 404, [], "State Not Found");
        }
        
        return respondWithTransformer($state, true, 200, [], "Fetched state successfuly");
    }

    public function stateLgas(Request $request, $id)
    {
        $state = State::findOrFail($id);

        if (!$state) {
            return respondWithTransformer([], true, 404, [], "State Not Found");
        }

        $lgas = LocalGovernment::where('state_id', $id)->get();

        if ($lgas->isEmpty()) {
            return respondWithTransformer([], true, 404, [], "LGA Not Found");
        }

        $data = $this->lgasResponse($lgas);
        return respondWithTransformer($data, true, 200, [], "Fetched lga successfuly");
    }

    public function stateLgasByTitle(Request $request, $title)
    {
        $state = State::whereRaw('LOWER(title) = ?', [strtolower($title)])->first();

        if (!$state) {
            return respondWithTransformer([], true, 404, [], "State Not Found");
        }

        $lgas = LocalGovernment::where('state_id', $state->id)->get();
        $data = $this->lgasResponse($lgas);
        return respondWithTransformer($data, true, 200, [], "Fetched lga successfuly");
    }

    public function lgas(Request $request)
    {
        $lga = LocalGovernment::where('status', 'Active')->latest()->get();
        $data = $this->lgasResponse($lga);
        return respondWithTransformer($data, true, 200, [], "Fetched Nigerian LGA successfuly");
    }

    public function lga($id)
    {
        $lga = LocalGovernment::find($id);

        if (!$lga) {
            return respondWithTransformer([], true, 404, [], "LGA Not Found");
        }

        return respondWithTransformer($lga, true, 200, [], "Fetched LGA successfuly");
    }

    public function lgaByTitle($title)
    {
        $lga = LocalGovernment::whereRaw('LOWER(title) = ?', [strtolower($title)])->first();

        if (!$lga) {
            return respondWithTransformer([], true, 404, [], "LGA Not Found");
        }
        
        return respondWithTransformer($lga, true, 200, [], "Fetched LGA successfuly");
    }

}
