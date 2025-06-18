<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\PoliticalZone;
use App\Models\SenatorialZone;
use Illuminate\Http\Request;

class ZonesController extends Controller
{
    //

    public function senatorialZones()
    {
        $zones = SenatorialZone::all();
        return respondWithTransformer($zones, true, 200, [], "All Senatorial zones fetched successfully");
    }

    public function politicalZones()
    {
        $zones = PoliticalZone::all();
        return respondWithTransformer($zones, true, 200, [], "All Political zones fetched successfully");
    }
}
