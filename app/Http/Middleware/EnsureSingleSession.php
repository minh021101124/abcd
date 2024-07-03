<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class EnsureSingleSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $sessionId = session()->getId();

            // Lấy session ID hiện tại của người dùng từ cache
            $cachedSessionId = Cache::get('user-session-' . $userId);

            // Nếu session ID trong cache khác với session ID hiện tại và session ID trong cache tồn tại
            if ($cachedSessionId && $cachedSessionId !== $sessionId) {
                Auth::logout();
                // Lưu thông báo vào session
                session()->flash('error', 'Tài khoản này đã được đăng nhập từ một nơi khác.');
                return redirect('/login');
            }

            // Cập nhật session ID vào cache
            Cache::put('user-session-' . $userId, $sessionId, config('session.lifetime'));
        }

        return $next($request);
    }
}