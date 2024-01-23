<div>
    <div class="px-4 sm:px-0 space-y-1">
        <h3 class="text-2xl font-semibold text-gray-900">Informazioni generali</h3>
        <p class="text-sm font-semibold text-fit-magenta">Tecniche di allenamento</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Conosci i movimenti base dell'allenamento in
                    sala pesi?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->know_basic_movements_of_weight_room ? 'Si' : 'No' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Conosci i movimenti complementari
                    dell'allenamento in sala pesi?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->know_complementary_movements_of_weight_room ? 'Si' : 'No' }}
                </dd>
            </div>
        </dl>
    </div>
</div>
