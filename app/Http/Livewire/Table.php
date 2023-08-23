<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $page = 1;

    public $sortBy = '';

    public $sortDirection = 'asc';

    public string $search = '';



    public abstract function query($search): \Illuminate\Database\Query\Builder;

    public abstract function columns(): array;

    //fonction de tri, prend en paramettre la clé de la colonne
    public function sort($key)
    {
        $this->resetPage();

        if ($this->sortBy === $key) {
            $direction = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            $this->sortDirection = $direction;

            return;
        }

        $this->sortBy = $key;
        $this->sortDirection = 'asc';
    }


    public function data()
    {
        return $this
            ->query($this->search)
            ->when($this->sortBy !== '', function ($query) {
                $query->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.table');
    }
}
