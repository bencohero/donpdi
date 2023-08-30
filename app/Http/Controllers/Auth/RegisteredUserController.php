<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Adress;
use App\Models\Phone;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phoneNumber' => ['required', 'integer'],
        ]);
        $adresse = Adress::create();
        //dd($adresse->id);
        //dd($request->phoneNumber);
        $user_id = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phoneNumber' => $request->phoneNumber,
            'adress_id' => $adresse->id,
        ]);

        $user = User::find($user_id);

        //dd($user_id);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'adress_id' => $adresse->id,
        // ]);

        // DB::table('phones')->insert([
        //     'code_pays' => $request->code_pays,
        //     'phoneNumber' => $request->phoneNumber,
        //     'owner_id' => $user_id,
        // ]);
        // Phone::create([
        //     'code_pays' => $request->code_pays,
        //     'phoneNumber' => $request->phoneNumber,
        //     'owner_id' => $user->id,
        // ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
