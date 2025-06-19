<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\LocalGovernment;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Http\Request;

class PollingUnitsController extends Controller
{
    
    public function index()
    {
        $parties = PollingUnit::all();
        return respondWithTransformer($parties, true, 200, [], "All parties fetched successfully");
    }

    public function view($id)
    {
        $party = PollingUnit::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        return respondWithTransformer($party, true, 200, [], "Party details fetched successfully");
    }

    public function byState(Request $request, $id)
    {
        $state = State::findOrFail($id);

        if (!$state) {
            return respondWithTransformer([], true, 404, [], "State Not Found");
        }

        $units = PollingUnit::where('state_id', $id)->get();

        if ($units->isEmpty()) {
            return respondWithTransformer([], true, 404, [], "units Not Found");
        }
        
        // $data = $this->lgasResponse($units);
        return respondWithTransformer($units, true, 200, [], "Fetched state's polling units successfuly");
    }

    public function byLga(Request $request, $id)
    {
        $lga = LocalGovernment::findOrFail($id);

        if (!$lga) {
            return respondWithTransformer([], true, 404, [], "Local Government Not Found");
        }

        $units = PollingUnit::where('local_government_id', $id)->get();

        if ($units->isEmpty()) {
            return respondWithTransformer([], true, 404, [], "units Not Found");
        }
        
        // $data = $this->lgasResponse($units);
        return respondWithTransformer($units, true, 200, [], "Fetched lga's polling units successfuly");
    }

    public function byWard(Request $request, $id)
    {
        $ward = Ward::findOrFail($id);

        if (!$ward) {
            return respondWithTransformer([], true, 404, [], "Ward Not Found");
        }

        $units = PollingUnit::where('ward_id', $id)->get();

        if ($units->isEmpty()) {
            return respondWithTransformer([], true, 404, [], "units Not Found");
        }
        
        // $data = $this->lgasResponse($units);
        return respondWithTransformer($units, true, 200, [], "Fetched ward's polling units successfuly");
    }

    public function add(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'abbr' => 'nullable|string|max:10',
            'logo' => 'nullable|string',
            'motto' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        $validator['status'] = GeneralStatus::ACTIVE; 
        $party = PollingUnit::create($validator);

        return respondWithTransformer($party, true, 201, [], "Party created successfully");
    }

    public function edit(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'abbr' => 'nullable|string|max:10',
            'logo' => 'nullable|string',
            'motto' => 'nullable|string',
        ]);
        
        if ($validator->fails()) {
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        $party = PollingUnit::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        $party->update($validator);

        return respondWithTransformer($party, true, 200, [], "Party updated successfully");
    }

    public function activate($id)
    {
        $party = PollingUnit::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        $party->status = 'active';
        $party->save();

        return respondWithTransformer($party, true, 200, [], "Party activated successfully");
    }

    public function deactivate($id)
    {
        $party = PollingUnit::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        $party->status = 'Inactive';
        $party->save();

        return respondWithTransformer($party, true, 200, [], "Party deactivated successfully");
    }

    public function delete($id)
    {
        $party = PollingUnit::find($id);
        if (!$party) {
            return respondWithTransformer(null, false, 404, [], "Party not found");
        }

        $party->delete();

        return respondWithTransformer(null, true, 200, [], "Party deleted successfully");
    }
}
