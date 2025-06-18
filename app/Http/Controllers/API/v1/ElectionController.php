<?php

namespace App\Http\Controllers\API\v1;

use App\Enum\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\ElectionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return respondWithTransformer($elections, true, 200, [], "All elections fetched successfully");
    }

    public function view($id)
    {
        $election = Election::find($id);
        if (!$election) {
            return respondWithTransformer([], false, 404, [], "Election not found");
        }

        return respondWithTransformer($election, true, 200, [], "Election details fetched successfully");
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
        $election = Election::create($validator);

        return respondWithTransformer($election, true, 201, [], "Election created successfully");
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

        $election = Election::find($id);
        if (!$election) {
            return respondWithTransformer([], false, 404, [], "Election not found");
        }

        $election->update($validator);

        return respondWithTransformer($election, true, 200, [], "Election updated successfully");
    }

    public function activate($id)
    {
        $election = Election::find($id);
        if (!$election) {
            return respondWithTransformer([], false, 404, [], "Election not found");
        }

        $election->status = 'active';
        $election->save();

        return respondWithTransformer($election, true, 200, [], "Election activated successfully");
    }

    public function deactivate($id)
    {
        $election = Election::find($id);
        if (!$election) {
            return respondWithTransformer([], false, 404, [], "Election not found");
        }

        $election->status = 'Inactive';
        $election->save();

        return respondWithTransformer($election, true, 200, [], "Election deactivated successfully");
    }

    public function delete($id)
    {
        $election = Election::find($id);
        if (!$election) {
            return respondWithTransformer(null, false, 404, [], "Election not found");
        }

        $election->delete();

        return respondWithTransformer(null, true, 200, [], "Election deleted successfully");
    }

    // Election types

    public function electionTypes()
    {
        $types = ElectionType::all();
        return respondWithTransformer($types, true, 200, [], "All election types fetched successfully");
    }

}
