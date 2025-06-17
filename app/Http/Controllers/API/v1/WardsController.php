<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WardsController extends Controller
{
    
    public function index()
    {
        $parties = Ward::all();
        return respondWithTransformer($parties, true, 200, [], "All parties fetched successfully");
    }

    public function view($id)
    {
        $party = Ward::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        return respondWithTransformer($party, true, 200, [], "Party details fetched successfully");
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
        $party = Ward::create($validator);

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

        $party = Ward::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        $party->update($validator);

        return respondWithTransformer($party, true, 200, [], "Party updated successfully");
    }

    public function activate($id)
    {
        $party = Ward::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        $party->status = 'active';
        $party->save();

        return respondWithTransformer($party, true, 200, [], "Party activated successfully");
    }

    public function deactivate($id)
    {
        $party = Ward::find($id);
        if (!$party) {
            return respondWithTransformer([], false, 404, [], "Party not found");
        }

        $party->status = 'Inactive';
        $party->save();

        return respondWithTransformer($party, true, 200, [], "Party deactivated successfully");
    }

    public function delete($id)
    {
        $party = Ward::find($id);
        if (!$party) {
            return respondWithTransformer(null, false, 404, [], "Party not found");
        }

        $party->delete();

        return respondWithTransformer(null, true, 200, [], "Party deleted successfully");
    }
}
