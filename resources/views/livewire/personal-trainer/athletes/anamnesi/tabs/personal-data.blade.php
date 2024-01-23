<div>
    <div class="px-4 sm:px-0 space-y-1">
        <h3 class="text-2xl font-semibold text-gray-900">Dati Anagrafici</h3>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Nome completo</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->full_name }}
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Data di nascita</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->informations->dob->format('d/m/Y') }} ({{ $athlete->age }} anni)
                </dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Nascita con parto</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ config('fitmatch.anamnesi.birth_with.'.$athlete->anamnesi->birth_with) }}
                </dd>
            </div>
        </dl>
    </div>
</div>
