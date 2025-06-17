<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Wallet;
use App\Models\UserLogs;
use App\Models\Referrals;
use App\Models\VirtualAccount;
use App\Notifications\SendOtpNotification;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Enum\TransactionStatus;
use App\Enum\UserRole;
use App\Services\Monnify\GetBanksService;
use App\Services\Monnify\VerifyBVNService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $userID = $request->user()->id;
        $user = User::findOrFail($userID);
        $data = $this->userResponse($user);
        return respondWithTransformer($data, true, 200, [], "Fetched current user successfuly");
    }

    public function isVerified(Request $request)
    {
        $user = $request->user();
        $data = [
            "status"=> ($user->isVerified == 1)? true : false
        ];
        return respondWithTransformer($data, true, 200, [], "Fetched user verification status successfuly");
    }

    public function updateProfile(Request $request)
    {
        // validation rule
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'firstName' => ['required', 'min:4'],
            'lastName' => ['required', 'min:4'],
            'dob' => 'required',
            'gender' => 'required',
            'nin' => 'required',
            'state' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) { 
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        $user = User::findOrFail($request->userId);
        if ($user && $user->id == auth('sanctum')->id()) {
            $user->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'state' => $request->state,
                'address' => $request->address,
            ]);
            $data = $this->userResponse($user);
            return respondWithTransformer($data, true, 200, [], "Profile has been updated!");           
        } else {
            return respondWithTransformer([], false, 400, [], "We can't verify the user");  
        }
        return respondWithTransformer([], false, 400, [], "There is an error. Try again");  
    }

    public function updatePassword(Request $request)
    {
        // validation rule
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'current_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) { 
            
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        $user = User::findOrFail($request->userId);
        // if user is verified, compare hashed passwords
        if ($user && Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return respondWithTransformer([], true, 200, [], "Password has been updated!");      
        } else {
            return respondWithTransformer([], false, 400, [], "Invalid current password");
        }
        return respondWithTransformer([], false, 400, [], "There is an error. Try again");
    }

    public function updatePin(Request $request)
    {
        // validation rule
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'current_password' => ['required', 'min:8'],
            'pin' => ['required', 'digits:4', 'confirmed'],
        ]);

        if ($validator->fails()) { 
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        $user = User::findOrFail($request->userId);
        // If user is verified, compare hashed passwords
        if ($user && Hash::check($request->input('current_password'), $user->password)) {
            $user->update([
                'pin' => Hash::make($request->pin),
            ]);
            return respondWithTransformer([], true, 200, [], "Pin has been updated!");      
        } else {
            return respondWithTransformer([], false, 400, [], "Provided password is incorrect");
        }
        return respondWithTransformer([], false, 400, [], "There is an error. Try again");
    }

    public function setPin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => ['required'],
            'pin' => ['required', 'digits:4', 'confirmed'],
        ]);

        if ($validator->fails()) { 
            
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }


        $user = User::findOrFail($request->userId);
        if ($user && is_null($user->pin)) {
            $user->update([
                'pin' => Hash::make($request->pin),
            ]);
            return respondWithTransformer([], true, 200, [], "Pin has been set!");      
        } else {
            return respondWithTransformer([], false, 400, [], "Pin is already set");
        }
        return respondWithTransformer([], false, 400, [], "There is an error. Try again");
    }
    
}
