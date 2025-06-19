<?php

namespace App\Http\Controllers\API\v1;

use App\Enum\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::all();
        return respondWithTransformer($results, true, 200, [], "All results fetched successfully");
    }

    public function view($id)
    {
        $result = Result::find($id);
        if (!$result) {
            return respondWithTransformer([], false, 404, [], "result not found");
        }

        return respondWithTransformer($result, true, 200, [], "result details fetched successfully");
    }

    public function add(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',

            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',

            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,mp4|max:10240', 

            'election' => 'required|exists:elections,id',
            'election_type' => 'required|string|max:100',

            'political_party' => 'required|exists:political_parties,id',
            'state' => 'required|exists:states,id',
            'lga' => 'required|exists:local_governments,id',
            'ward' => 'required|exists:wards,id',
            'polling_unit' => 'required|exists:polling_units,id',

            'constituency' => 'nullable|string|max:100', 
            
        ]);

        if ($validator->fails()) {
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        // Attempt to get user by phone
        $user = User::where('phone', $request->agent_phone)->first();
        $userId = $user ? $user->id : null;

        $result = new Result();
        $result->user_id = $userId;
        $result->agent_name = $request->name;
        $result->agent_phone = $request->phone;

        $result->election_id = $request->election;
        $result->election_type = $request->election_type;
        $result->political_party_id = $request->party;

        $result->state_id = $request->state;
        $result->local_government_id = $request->lga;
        $result->ward_id = $request->ward;
        $result->polling_unit_id = $request->polling_unit;

        $result->constituency_id = $request->constituency;
        $result->status = GeneralStatus::ACTIVE; 

        // Handle media upload (if exists)
        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('results', 'public');
            $result->media = $path;
        }

        $result->save();

        return respondWithTransformer($result, true, 201, [], "result created successfully");
    }
}
