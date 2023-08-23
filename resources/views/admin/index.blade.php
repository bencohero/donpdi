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
                <div class="w-full text-gray-900 dark:text-gray-100">    
                    <livewire:don-table></livewire:don-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>