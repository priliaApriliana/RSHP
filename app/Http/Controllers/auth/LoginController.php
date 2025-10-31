<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; //tambahan
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    //tampilkan form login (kalo mau nganti css)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //proses login           
    public function login(Request $request)
    {
        //validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //ambil user beserta role yang aktif
        $user = User::with(['roleUser' => function($query) {
                $query->where('status', 1);
        }, 'roleUser.role'])
        ->where('email', $request->input('email'))
        ->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        //cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        //ambil data role user
        $roleId = $user->roleUser[0]->idrole ?? null;
        $namaRole = Role::where('idrole', $user->roleUser(0)->idrole ?? null)->first();

        //login user ke sessionn laravel
        Auth::login($user);

        //simpan data user ke session
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role_id' => $roleId,
             'user_role' => $roleId,
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUser(0)->status ?? 'active'
        ]);

        switch ($roleId) {
            case '1':
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case '2':
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case '3':
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case '4':
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            case '5':
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
            // default:
            //     return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
        }
    }

    public function logout(Request $request) 
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'logout berhasil!');
    }
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    /**
     * Create a new controller instance.
     *
     * @return void
     */



}
