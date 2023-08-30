<?php

namespace App\Http\Controllers;

require('Ligdicash.php');

use App\Http\Requests\StoreDonRequest;
use App\Http\Requests\UpdateDonRequest;
use App\LGD\Ligdicash;
use App\Models\Don;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // $dons = DB::table('dons')->where('id_donateur', '=', Auth::id())->count();
        // dd($dons);
        return View(
            'don.index',
            [
                'dons' => DB::table('dons')->where('id_donateur', '=', Auth::id())->get(),
                'total' => DB::table('dons')->where('id_donateur', '=', Auth::id())->sum('montant')
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return View('don.faireUnDon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDonRequest $request): RedirectResponse
    {

        $numtransaction = fake()->numerify('LCD.####.####.').date('m').date('d').'.'.date('h'). date('m').'.C'.rand(5, 10000);

        if ($request->validated()) {

            $response =Ligdicash::ligdicashWithRedirection(Auth::user()->id,$request->montant,$request->firstname,$request->lastname,$request->email, $numtransaction);
            
            Don::create([
                'montant' => $request->montant,
                'numeroTransaction' => $numtransaction,
                'token' => $response->token,
                'id_donateur' => Auth::id()
            ]);

            session(['invoiceToken' => $response->token]);
            //dd($request->session()->exists('invoiceToken'));
            if ($response->response_code == 00) {
                # code...
                return redirect($response->response_text);
            } else {
                return back()->with('info', 'la requête a échoué, soumettez à nouveau le formulaire');
            }
        }
        return back()->with('info', 'la requête a échoué, soumettez à nouveau le formulaire');
    }


    public function cancelPayment()
    {
        return redirect()->route('dons.don')->with('info', 'Vous avez annulé votre don !!!!');
    }

    public function payStatus(): RedirectResponse
    {   
        $response = Ligdicash::ligdicashGetPayStatus(session('invoiceToken'));
        //dd($response);

        if ($response->status == 'completed') {
            //dd(Don::where('token', session('invoiceToken')));
            Don::where('token', session('invoiceToken'))->update(['status' => $response->status]);
            
            return redirect('/dons');
        } elseif ($response->status == 'pending') {
            
            return redirect('/dons');
        } else {

            Don::where('token', session('invoiceToken'))->update(['status' => $response->status]);
            
            return redirect('/dons');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $don = Don::find($id);
        return View($don);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDonRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
