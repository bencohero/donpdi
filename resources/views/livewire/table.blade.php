<div>
  <div class="w-full flex h-14 mb-3 p-2 bg-white dark:bg-slate-500 text-slate-900">
    <div class="w-1/3">
      <input type="text" wire:model="search" class="w-full rounded" name="search" id="" placeholder="chercher ...">
    </div>
    <div class="w-1/3 ml-3">
      <select wire:model="perPage" name="perPage" aria-placeholder="Nombre de lignes par page" class="w-full rounded  align-content-end" id="">
        <option value="10">--Choisir nombre de lignes par page--</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
      </select>
    </div>
  </div>
  @if($this->data()->isNotEmpty()) 
  <div class="relative overflow-x-auto shadow-md rounded-lg bg-white dark:bg-slate-500">
    <table class="w-full text-left text-slate-100 ">
      <thead class="border-b">
        <tr class="w-full ">
          @foreach($this->columns() as $column)
          <th wire:click="sort('{{ $column->key }}')">
            <div class="py-3 px-6 flex items-center cursor-pointer">
              {{ $column->label }}
              @if($sortBy === $column->key)
              @if ($sortDirection === 'asc')
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
              @else
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
              </svg>
              @endif
              @endif
            </div>
          </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($this->data() as $row)
        <tr class="bg-white dark:bg-slate-500 border-b hover:bg-slate-400 hover:text-slate-50">
          @foreach($this->columns() as $column)
          @switch($column->key)
          @case('created_at')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->created_at">
              </x-dynamic-component>
            </div>
          </td>
          @break
          @case('email')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->email">
              </x-dynamic-component>
            </div>
          </td>
          @break
          @case('montant')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->montant">
            </x-dynamic-component>
            </div>
          </td>
          @break
          @case('numeroTransaction')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->numeroTransaction">
              </x-dynamic-component>
            </div>
          </td>
          @break
          @case('firstname')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->firstname">
              </x-dynamic-component>
            </div>
          </td>
          @break
          @case('status')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->status">
              </x-dynamic-component>
            </div>
          </td>
          @break
          @case('lastname')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->lastname">
              </x-dynamic-component>
            </div>
          </td>
          @break
          @case('id')
          <td>
            <div class="py-3 px-6 flex items-center cursor-pointer">
              <x-dynamic-component :component="$column->component" :value="$row->id">
              </x-dynamic-component>
            </div>
          </td>
          @break
          @endswitch
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-slate-50 mt-1">
      {{ $this->data()->links() }}
    </div>
  </div>
  @else
    <div class="w-full h-8 border bg-slate-300 text-red-600">Aucune donnée n'a été trouvée !!</div>
  @endif
</div>