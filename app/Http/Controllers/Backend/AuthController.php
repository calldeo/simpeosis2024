<?php 
namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller{


public function index(Request $request)
        {
            $credentials = $request->only('email', 'password');
    
            if (Auth::guard('tb_siswa')->attempt($credentials)) {
                $auth = Auth::guard('tb_siswa')->user();
                $auth['api_token']=$auth->createToken('auth_token')->plainTextToken;
    
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil' ,
                    'data' => $auth
                ]);
            } else {
                return response()->json([
                   
                    'success' => false,
                    'message' => 'Email atau password salah',
                    'data' => null
                    
                ]);
            }
        }
    }


?>