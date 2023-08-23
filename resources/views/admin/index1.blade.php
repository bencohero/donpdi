<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administration-Donpdi') }}
        </h2>
    </x-slot>
    <!-- @if(session('info'))
        <div class="alert alert-info">{{session('info')}}</div>
    @endif -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">    
                <table class="w-full bg-gray text-light-800">
                        <thead class="border-b">
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Numero de transaction</th>
                                <th>Montant</th>
                                <th>Date de transaction</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody class="text-center h-1">
                            @foreach($datas as $data)
                            <tr>
                                <td>{{$data->firstname==null ? '-' : $data->firstname}}</td>
                                <td>{{$data->lastname==null ? '-' : $data->lastname}}</td>
                                <td>{{$data->numeroTransaction}}</td>
                                <td>{{$data->montant}}</td>
                                <td>{{$data->date}}</td>
                                <td>{{$data->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>