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
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Enum\ReferralStatus;
use App\Enum\TransactionStatus;
use App\Enum\UserRole;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return respondWithTransformer([], true, 200, [], "Welcome to user authentication");
    }

    //
    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }
    
    
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check if user is not active
            if ($user->status !== 'Active') {
                Auth::logout(); 

                return respondWithTransformer([], false, 403, [], "Your account is not active. Please contact support.");
            }

            // Generate token via Sanctum
            $token = $user->createToken('auth_token')->plainTextToken;

            // Prepare response data
            $data = $this->userResponse($user);
            $data['token'] = $token;

            return respondWithTransformer($data, true, 200, [], "Sign In successfully");
        }

        return respondWithTransformer([], false, 403, [], "Invalid Credential");
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'min:4'],
            'last_name' => ['required', 'min:4'],
            'gender' => 'nullable|max:15',
            'phone' => 'required|unique:users|min:11|max:15',
            'state' => 'nullable|max:15',
            'lga' => 'nullable|max:15',
            'address' => 'nullable',
            // 'role' => 'required|in:Admin,Agent,Supporter|max:15',
            'polling_unit' => 'nullable',
            'ward' => 'nullable|max:15',
            'voter_number' => 'nullable',
            // 'email' => 'required|email|unique:users',
            // 'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }
        
    
        $password = $request->password ?? $request->phone;
        $user = User::create([
            'firstName' => $request->first_name,
            'lastName' => $request->last_name,
            'gender' => $request->gender,
            'state' => $request->state,
            'lga' => $request->lga,
            'address' => $request->address,
            'phone' => $request->phone,
            'polling_unit_id' => $request->polling_unit,
            'voter_number' => $request->voter_number,
            'phone' => $request->phone,
            'role' => 'Memeber',
            'status' => 'Active',
            'password' => Hash::make($password),
        ]);
    
        
        $data = $this->userResponse($user);
            
        return respondWithTransformer($data, true, 201, [], "Account created successfully");
    }

    public function forget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) { 
            return respondWithTransformer(['errors' => $validator->errors()], false, 400, [], 'Validation error(s)');
        }

        // check the email
        $user = User::withEmail($request->email)->first();

        if(!$user) { return respondWithTransformer([], false, 404, [], "No user found with this email."); }

        // generate otp
        $code = generateOTP();
        // save the verification code to the user model
        $user->token = $code;
        $user->generated_at = Carbon::now();
        if($user->save())
        {
            $user->notify(new SendOtpNotification($code));
            return respondWithTransformer(['email'=> $request->email], true, 200, [], "OTP has been sent");
        }

        return respondWithTransformer([], false, 400, [], "Error, Ty again later");
    }

    public function reset(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->errors()], 400);
        }
        
        $user = User::withEmail($request->email)->first();
        
        if(!$user) { return respondWithTransformer([], false, 404, [], "Cannot find user with this email."); }

        if($user->token !== $request->token) { return respondWithTransformer([], false, 404, [], "Invalid Token."); }

        // calculate if token is expired
        $generatedAt = Carbon::parse($user->generated_at); 
        $expiresAt = $generatedAt->addMinutes(10);

        if (now()->greaterThan($expiresAt)) { return respondWithTransformer([], false, 400, [], "Token has expired"); }

        // token is valid, update the password
        $user->password = bcrypt($request->password);
        $user->token = null; 
        $user->generated_at = null; 
        $user->save();

        return respondWithTransformer([], true, 200, [], "Password has been updated");
    }

}
