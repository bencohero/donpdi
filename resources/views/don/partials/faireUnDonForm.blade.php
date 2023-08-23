<section>


    <form method="post" action="{{ route('dons.don.faire') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="montant" :value="__('Montant')" />
            <x-text-input id="montant" name="montant" type="number" min='100' max='1000000' class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('montant')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Faire mon don') }}</x-primary-button>
        </div>
    </form>
</section>