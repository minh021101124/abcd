<?php
 
 namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }

    public function change()
    {
        return view('password-change');
    }
   

   

    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/admin')->with('success', 'Đăng nhập thành công !');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng !');
    }
    public function registerPost(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success', 'Đăng ký thành công !');
    }
    public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:4|confirmed',
    ]);
    $user = Auth::user();
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with('error', 'Mật khẩu hiện tại không chính xác');
    }
    $user->password = Hash::make($request->new_password);
    $user->save();
    Auth::logout();
    return redirect('/login')->with('success', 'Mật khẩu đã được thay đổi thành công . Vui lòng đăng nhập lại bằng mật khẩu mới.');
}
    public function logout(Request $request)
    {
        $userId = Auth::id();
        Cache::forget('user-session-' . $userId);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'Đăng xuất thành công!');
    }
}
