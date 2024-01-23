<div>
    <div class="px-4 sm:px-0 space-y-1">
        <h3 class="text-2xl font-semibold text-gray-900">Fisiologia</h3>
        <p class="text-sm font-semibold text-fit-magenta">Dieta</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Utilizzi integratori alimentari attualmente?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->nutritional_supplements ? 'Si' : 'No' }}
                </dd>
            </div>
            @if($athlete->anamnesi->nutritional_supplements)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-fit-medium leading-6 text-gray-900">Quali?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $athlete->anamnesi->nutritional_supplements_yes_which ?: '-' }}
                    </dd>
                </div>
            @endif
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Hai utilizzato integratori alimentari in
                    passato?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->nutritional_supplements_in_past ? 'Si' : 'No' }}
                </dd>
            </div>
            @if($athlete->anamnesi->nutritional_supplements_in_past)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-fit-medium leading-6 text-gray-900">Quali?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $athlete->anamnesi->nutritional_supplements_in_past_yes_which ?: '-' }}
                    </dd>
                </div>
            @endif
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Hai allergie alimentari?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->allergies ? 'Si' : 'No' }}
                </dd>
            </div>
            @if($athlete->anamnesi->allergies)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-fit-medium leading-6 text-gray-900">Quali?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $athlete->anamnesi->allergies_yes_which ?: '-' }}
                    </dd>
                </div>
            @endif
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Hai intolleranze alimentari?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->intolerances ? 'Si' : 'No' }}
                </dd>
            </div>
            @if($athlete->anamnesi->intolerances)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-fit-medium leading-6 text-gray-900">Quali?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $athlete->anamnesi->intolerances_yes_which ?: '-' }}
                    </dd>
                </div>
            @endif
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Hai mai sofferto di difficoltà digestive o
                    dolore post prandiale?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->digestive_difficulties ? 'Si' : 'No' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Quanta acqua consumi al giorno?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->water_per_day ?: '-' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Hai mai sofferto di disturbi del
                    comportamento
                    alimentare?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->eating_disorders ? 'Si' : 'No' }}
                </dd>
            </div>
        </dl>
    </div>
</div>
