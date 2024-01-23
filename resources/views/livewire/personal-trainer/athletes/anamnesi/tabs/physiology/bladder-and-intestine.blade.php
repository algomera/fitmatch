<div>
    <div class="px-4 sm:px-0 space-y-1">
        <h3 class="text-2xl font-semibold text-gray-900">Fisiologia</h3>
        <p class="text-sm font-semibold text-fit-magenta">Vescica e Intestino</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Urinazione regolare?</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->regular_urination ? 'Si' : 'No' }}
                </dd>
            </div>
            @if(!$athlete->anamnesi->regular_urination)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-fit-medium leading-6 text-gray-900">Per quale motivo?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $athlete->anamnesi->regular_urination_no_why ?: '-' }}
                    </dd>
                </div>
            @endif
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-fit-medium leading-6 text-gray-900">Defecazione regolare?</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {{ $athlete->anamnesi->regular_defecation ? 'Si' : 'No' }}
                </dd>
            </div>
            @if(!$athlete->anamnesi->regular_defecation)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-fit-medium leading-6 text-gray-900">Per quale motivo?</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        {{ $athlete->anamnesi->regular_defecation_no_why ?: '-' }}
                    </dd>
                </div>
            @endif
        </dl>
    </div>
</div>
