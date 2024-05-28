<?php

namespace App\Http\Controllers\Api\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Company;
use App\Models\TCompany;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(AuthRequest $request)
    {
        $user = User::create([
            'role_id' => $request->role_id,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $company = new Company([
            'country' => $request->country,
            'languages' => json_encode($request->languages),
            'referral_code' => $request->referral_code,
        ]);
        $user->company()->save($company);
        
        $languages = ['vi', 'en', 'ja'];
        foreach ($languages as $language) {
            $t_company = new TCompany([
                'company_name' => $request->company_name,
                'language' => $language,
            ]);
            $company->translate()->save($t_company);
        }

        
        return response()->json([
            "message" => "Create user success",
        ], 200);
    }
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Invalid Account'], 404);
        }
    
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Wrong password'], 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken($user->email, ['*'], now()->addWeek());
        return response()->json([
            'accessToken' => $token,
            'message' => 'Login success',
        ], 200);
    }
}
