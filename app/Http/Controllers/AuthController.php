<?php

    namespace App\Http\Controllers;

    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;


    class AuthController extends Controller
    {
        public function register(Request $request): \Illuminate\Http\JsonResponse
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $user->createToken('AuthToken')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 201);
        }

        public function login(Request $request): \Illuminate\Http\JsonResponse
        {

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $token = $user->createToken('AuthToken')->plainTextToken;

                return response()->json(['user' => $user, 'token' => $token], 200);
            }

            return response()->json(['error' => 'Unauthorized'], 401);
        }

        public function logout(Request $request): \Illuminate\Http\JsonResponse
        {
            $request->user()->tokens()->delete();

            return response()->json(['message' => 'Logged out successfully'], 200);
        }
    }
