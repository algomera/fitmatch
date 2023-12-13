<div>
    <div class="px-4 sm:px-0 space-y-1">
        <h3 class="text-2xl font-semibold text-gray-900">Fisiologia</h3>
        <p class="text-sm font-semibold text-fit-magenta">Ciclo Mestruale</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Età del menarca
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->age_of_menarche ?: '-' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Ciclo mestruale
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ config('fitmatch.anamnesi.mestrual_cycle.'.$athlete->anamnesi->mestrual_cycle) ?: '-' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Grado di dolore del ciclo mestruale
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->pain_of_mestrual_cycle ?: '-' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Menopausa
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ config('fitmatch.anamnesi.menopause.'.$athlete->anamnesi->menopause) ?: '-' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Usi contraccettivi?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->contraceptives ? 'Si' : 'No' }}
                </dd>
            </div>
            @if($athlete->anamnesi->contraceptives)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Se si, perché?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ config('fitmatch.anamnesi.contraceptives_yes_why.'.$athlete->anamnesi->contraceptives_yes_why) ?: '-' }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Quali?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ config('fitmatch.anamnesi.contraceptives_yes_which.'.$athlete->anamnesi->contraceptives_yes_which) ?: '-' }}
                    </dd>
                </div>
            @endif
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Hai avuto gravidanze?
                </dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->pregnancies ? 'Si' : 'No' }}
                </dd>
            </div>
            @if($athlete->anamnesi->pregnancies)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Se si, quante?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $athlete->anamnesi->pregnancies_yes_how_many ?: '-' }}
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Che tipo di parto?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ config('fitmatch.anamnesi.pregnancies_type_of_section.'.$athlete->anamnesi->pregnancies_type_of_section) ?: '-' }}
                    </dd>
                </div>
            @endif
        </dl>
    </div>
</div>
