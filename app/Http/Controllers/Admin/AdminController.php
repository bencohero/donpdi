<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $data= DB::select('select u.name, u.firstname, u.lastname, d.numeroTransaction, d.montant,d.created_at as date, d.status from users u, dons d where u.id = d.id_donateur');
        return View('admin.index', ['datas' => $data]);
    }
}
