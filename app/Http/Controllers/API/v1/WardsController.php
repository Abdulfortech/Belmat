<?php

namespace App\Http\Controllers\API\v1;

use App\Enum\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\LocalGovernment;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WardsController extends Controller
{
    
    public function index()
    {
        $wards = Ward::all();
        return respondWithTransformer($wards, true, 200, [], "All wards fetched successfully");
    }

    public function byState(Request $request, $id)
    {
        $state = State::findOrFail($id);

        if (!$state) {
            return respondWithTransformer([], true, 404, [], "State Not Found");
        }

        $wards = Ward::where('state_id', $id)->get();

        if ($wards->isEmpty()) {
            return respondWithTransformer([], true, 404, [], "wards Not Found");
        }
        
        // $data = $this->lgasResponse($wards);
        return respondWithTransformer($wards, true, 200, [], "Fetched state's wards successfuly");
    }

    public function byLga(Request $request, $id)
    {
        $lga = LocalGovernment::findOrFail($id);

        if (!$lga) {
            return respondWithTransformer([], true, 404, [], "Local Government Not Found");
        }

        $wards = Ward::where('local_government_id', $id)->get();

        if ($wards->isEmpty()) {
            return respondWithTransformer([], true, 404, [], "wards Not Found");
        }
        
        // $data = $this->lgasResponse($wards);
        return respondWithTransformer($wards, true, 200, [], "Fetched lga's wards successfuly");
    }

    public function view($id)
    {
        $ward = Ward::find($id);
        if (!$ward) {
            return respondWithTransformer([], false, 404, [], "ward not found");
        }

        return respondWithTransformer($ward, true, 200, [], "Ward details fetched successfully");
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
        $ward = Ward::create($validator);

        return respondWithTransformer($ward, true, 201, [], "ward created successfully");
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

        $ward = Ward::find($id);
        if (!$ward) {
            return respondWithTransformer([], false, 404, [], "ward not found");
        }

        $ward->update($validator);

        return respondWithTransformer($ward, true, 200, [], "ward updated successfully");
    }

    public function activate($id)
    {
        $ward = Ward::find($id);
        if (!$ward) {
            return respondWithTransformer([], false, 404, [], "ward not found");
        }

        $ward->status = 'active';
        $ward->save();

        return respondWithTransformer($ward, true, 200, [], "ward activated successfully");
    }

    public function deactivate($id)
    {
        $ward = Ward::find($id);
        if (!$ward) {
            return respondWithTransformer([], false, 404, [], "ward not found");
        }

        $ward->status = 'Inactive';
        $ward->save();

        return respondWithTransformer($ward, true, 200, [], "Ward deactivated successfully");
    }

    public function delete($id)
    {
        $ward = Ward::find($id);
        if (!$ward) {
            return respondWithTransformer(null, false, 404, [], "ward not found");
        }

        $ward->delete();

        return respondWithTransformer(null, true, 200, [], "ward deleted successfully");
    }
    
}
