<?php

namespace App\Http\Livewire;

use App\Models\Don;
use App\Models\User;
use DataTable\Table\Column;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

require('Table/Column.php');



class DonTable extends Table
{

  public function query($search): Builder
  {
    // dd(DB::table('dons')
    // ->join('users', 'dons.id_donateur', '=', 'users.id')
    // ->select('dons.id', 'dons.montant', 'dons.numeroTransaction', 'dons.created_at', 'dons.status', 'users.name', 'users.email')->get());

    // dd(User::with(['dons' => function (Builder $query) {
    //   $query->orderBy('created_at', 'asc');
    // }])->get()->toArray());
    return empty($search) ? (DB::table('dons')
      ->join('users', 'dons.id_donateur', '=', 'users.id')
      ->select('dons.id', 'dons.montant', 'dons.numeroTransaction', 'dons.created_at', 'dons.status', 'users.name', 'users.firstname', 'users.lastname', 'users.email')) : (DB::table('dons')
        ->join('users', 'dons.id_donateur', '=', 'users.id')
        ->select('dons.id', 'dons.montant', 'dons.numeroTransaction', 'dons.created_at', 'dons.status', 'users.name', 'users.firstname', 'users.lastname', 'users.email')
        ->where('firstname', 'like', '%' . $search . '%')
        ->orWhere('lastname', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%')
      );
  }

  public function columns(): array
  {
    return [
      Column::make('id', 'ID'),
      Column::make('lastname', 'Nom'),
      Column::make('firstname', 'Prénom'),
      Column::make('email', 'Email'),
      Column::make('montant', 'Montant'),
      Column::make('numeroTransaction', 'Numero de transaction'),
      Column::make('status', 'Status')->component('columns.status'),
      Column::make('created_at', 'Date de la transaction'),
      Column::make('created_at', 'Durée')->component('columns.humanDiffs'),
    ];
  }
}
