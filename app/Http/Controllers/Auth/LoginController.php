<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


// INI UDAH GA KEPAKE YAAA PINDAH KE AUTHENTICATEDSESSIONCONTROLLER
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Pastikan halaman login berada di resources/views/login.blade.php
    }
    
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->role == '7') {
                return redirect()->intended('user');
            }
        }
        return view('login');
        }
        
        public function proses_login(Request $request)
        {
            request()->validate(
                [
                    'email' => 'required',
                    'password' => 'required',
                ]
            );
        
            $kredensil = $request->only('email', 'password');
        
            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                if ($user->role == '7') {
                    return redirect()->intended('user');
                } 
                // elseif ($user->level == 'editor') {
                //     return redirect()->intended('editor');
                // }
                return redirect()->intended('/login');
            }
        
            return redirect('login')
                ->withInput()
                ->withErrors(['login_gagal' => 'These credentials do not match our records.']);
        }
        
        public function logout(Request $request)
        {
            $request->session()->flush();
            Auth::logout();
            return Redirect('login');
        }        
    }
    