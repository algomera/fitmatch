<div class="mx-auto w-full max-w-4xl px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">
        <h2 class="text-4xl font-semibold leading-7 text-fit-black">Piani</h2>
        <p class="mt-5 text-base tracking-tight text-gray-900">
            Scegli il piano più adatto alle tue esigenze
        </p>
    </div>
    <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-2">
        <div
            class="grid items-center rounded-3xl p-8 xl:p-10 bg-white shadow-xl">
            <h3 class="text-3xl font-semibold leading-8 text-center text-gray-900">
                Mensile
            </h3>
            <p class="mt-4 text-fit-dark-gray text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Asperiores aspernatur consectetur cum,
                doloribus ducimus earum est facere.</p>
            <p class="mt-6 flex justify-center items-baseline text-4xl font-bold tracking-tight text-fit-magenta">
                €10.00/mese
            </p>
            <p class="mt-2 flex justify-center items-baseline text-sm tracking-tight text-fit-dark-gray">
                €120.00/anno
            </p>
            <x-primary-button wire:click="checkout('price_1OVA0PHh1WgVtzWEyyoz0gj8')" class="justify-center mt-10">
                Iscriviti
            </x-primary-button>
        </div>
        <div
            class="grid items-center rounded-3xl p-8 xl:p-10 bg-white shadow-xl">
            <h3 class="text-3xl font-semibold leading-8 text-center text-gray-900">
                Annuale
            </h3>
            <p class="mt-4 text-fit-dark-gray text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Asperiores aspernatur consectetur cum,
                doloribus ducimus earum est facere.</p>
            <p class="mt-6 flex justify-center items-baseline text-4xl font-bold tracking-tight text-fit-magenta">
                €50.00/anno
            </p>
            <p class="mt-2 flex justify-center items-baseline text-sm tracking-tight text-fit-dark-gray">
                €4.16/mese
            </p>
            <x-primary-button wire:click="checkout('price_1OVA0sHh1WgVtzWEZjYMJbyI')" class="justify-center mt-10">
                Iscriviti
            </x-primary-button>
        </div>
    </div>
</div>
