<div>
    <div class="px-4 sm:px-0 space-y-1">
        <h3 class="text-2xl font-semibold text-gray-900">Fisiologia</h3>
        <p class="text-sm font-semibold text-fit-magenta">Fumo e Bevande</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Fumo</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ config('fitmatch.anamnesi.smoke.'.$athlete->anamnesi->smoke) ?: '-' }}
                    @if($athlete->anamnesi->smoke === 'yes')
                        ({{ $athlete->anamnesi->smoke_yes_how_many_per_day ?: '-' }} al giorno)
                    @endif
                    @if($athlete->anamnesi->smoke === 'stopped')
                        (da {{ $athlete->anamnesi->smoke_stopped_since->format('d/m/Y') ?: '-' }})
                    @endif
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Bevande alcoliche</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ config('fitmatch.anamnesi.alcohol.'.$athlete->anamnesi->alcohol) ?: '-' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Caffè</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->coffee ? 'Si' : 'No' }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Stress</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ config('fitmatch.anamnesi.stress_level.'.$athlete->anamnesi->stress_level) ?: '-' }}
                </dd>
            </div>
        </dl>
    </div>
</div>
