<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Jobs\CheckEmailAfterRegistration;

class AuthController extends Controller
{
    public function registration(Request $request) 
    {
        $validated = $request->validate([
            'name' => ['required', 'max:100'],
            'login' => ['required', 'regex:/^(\w*\d+\w*)$/'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'email' => ['required', 'email', 'unique:users'],        
            'password' => ['required', 'confirmed', 'regex:/^(.*(([0-9].*[A-Z])|([A-Z].*[0-9])).*)$/'],
        ]);
        
        $user = User::create($validated);

        Auth::login($user);

        $request->session()->regenerate();

        event(new Registered($user));

        CheckEmailAfterRegistration::dispatch($user->id)
            ->delay(now()->addMinutes(2));

        return redirect('index');
    }

    public function authentication(Request $request) 
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],       
            'password' => ['required', 'regex:/^(.*(([0-9].*[A-Z])|([A-Z].*[0-9])).*)$/'],
        ]);
        
        if (Auth::attempt($validated))
        {
            $request->session()->regenerate();
            
            return redirect('index');
        }

        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('login');
    }

    public function editUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:100'],
            'login' => ['required', 'regex:/^(\w*\d+\w*)$/'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'email' => ['required', 'email']
        ]);

        $user = Auth::user();

        $user->name = $validated['name'];
        $user->login = $validated['login'];
        $user->phone = $validated['phone'];
        $user->email = $validated['email'];

        $user->save();

        return redirect('profile');
    }

    public function editPassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => ['required', 'regex:/^(.*(([0-9].*[A-Z])|([A-Z].*[0-9])).*)$/'],
            'new_password' => ['required', 'regex:/^(.*(([0-9].*[A-Z])|([A-Z].*[0-9])).*)$/'],
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['old_password'], $user->password)) {
            return back()->withErrors([
                'old_password' => ['Не верный пароль.']
            ]);
        }

        $user->password = $validated['new_password'];
        
        $user->save();

        return redirect('profile');
    }
}
