<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Adress;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {   //$phone =Phone::where('owner_id', Auth::id());
        // $phone =$request->user()->phoneNumber()->get()[0];
        // dd($phone->code_pays);
        // dd($request->user()->phoneNumber()->get());
        //dd($request->user()->adress_id);
        //$adresse = Adress::where('id', $request->user()->adress_id)->get();
        //dd($adresse);
        return view('profile.edit', [
            'user' => $request->user(),
            'adresse' => Adress::where('id', $request->user()->adress_id)->get()[0],
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        //$request->user()->fill($request->validated());

        if($request->validated())
        {   
            Adress::where('id', $request->user()->adress_id)->update([
                'pays' => $request->pays,
                'ville' => $request->ville,
                'postale' => $request->postale,
            ]);


            $request->user()->name = $request->name;
            $request->user()->firstname = $request->firstname;
            $request->user()->lastname = $request->lastname;
            $request->user()->email = $request->email;
            $request->user()->phoneNumber = $request->phoneNumber;

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }
    
            $request->user()->save();
        }

        return Redirect::route('profile.edit')->with('status', 'Votre profile a été mis à jour avec succès !!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
