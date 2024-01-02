<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request) {
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
   
        // $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'The given data is invalid'
            ], 422);
        }

        return $request->user();

        // $user = User::where('email', $request->email)->first();
        // $authToken = $user->createToken('auth-token')->plainTextToken;

        // return response()->json([
        //     'access_token' => $authToken,
        //     'status' => 200
        // ]);
    }

    public function registration() {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request) {  
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
           
        $data = $request->all();
        $user = $this->create($data);
        
        $token = $user->createToken('customAuthToken')->plainTextToken;
        
        
        $user->roles()->attach(4);
        return response()->json($user);

        // $response = [
        //     'user' => $user,
        //     'token' => $token
        // ];
         
        // return response($response, 201);
    }

    public function create(array $data) {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard() {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function status() {
        return Auth::check();
    }
    
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return [
            'message' => 'Loged out',
            'status' => 200
        ];
    }
}