<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mon espace de don') }}
        </h2>
    </x-slot>
    @if(session('info'))
        <div class="alert alert-info">{{session('info')}}</div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="w-full">
                        <thead class="border-b">
                            <tr class="border-bottom">
                                <th class="">Date</th>
                                <th class="">Numéro de transaction</th>
                                <th class="">Montant</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($dons as $don)
                            <tr class="h-1">
                                <td class="">{{$don->created_at}}</td>
                                <td class="">{{$don->numeroTransaction}}</td>
                                <td class="">{{$don->montant}} F CFA</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-6 text-white text-end text-5xl"> Total de vos dons: {{number_format($total,0,' ', " ")}} F CFA</div>
                </div>               
            </div>
        </div>
    </div>
</x-app-layout>