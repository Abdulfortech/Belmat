<?php

namespace App\Http\Controllers\API\v1;

use App\Enum\GeneralStatus;
use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SuggestionController extends Controller
{
    public function index()
    {
        $suggestions = Suggestion::all();
        return respondWithTransformer($suggestions, true, 200, [], "All suggestions fetched successfully");
    }

    public function view($id)
    {
        $suggestion = Suggestion::find($id);
        if (!$suggestion) {
            return respondWithTransformer([], false, 404, [], "suggestion not found");
        }

        return respondWithTransformer($suggestion, true, 200, [], "suggestion details fetched successfully");
    }

    public function add(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'state'   => 'required|integer|exists:states,id',
            'lga'     => 'required|integer|exists:local_governments,id',
            'content' => 'required|string',
            'media'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // accepts only images
        ]);

        if ($validator->fails()) {
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        // Attempt to get user by phone
        $user = User::where('phone', $request->phone)->first();
        $userId = $user ? $user->id : null;

        // $validator['status'] = GeneralStatus::ACTIVE; 

        $suggestion = new Suggestion();
        $suggestion->user_id = $userId;
        $suggestion->name = $request->name;
        $suggestion->phone = $request->phone;
        $suggestion->state_id = $request->state;
        $suggestion->lga_id = $request->lga;
        $suggestion->content = $request->content;
        $suggestion->status = GeneralStatus::ACTIVE; 

        // Handle media upload (if exists)
        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('suggestions', 'public');
            $suggestion->media = $path;
        }

        $suggestion->save();

        return respondWithTransformer($suggestion, true, 201, [], "suggestion created successfully");
    }

}
