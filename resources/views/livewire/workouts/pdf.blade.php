<div class="w-[210mm]">
    <table class="border w-[210mm] divide-y divide-gray-300">
        <tbody class="divide-y divide-gray-200 bg-white">
        @foreach($workout->workout_weeks()->whereHas('workout_days')->get() as $week)
            <tr class="divide-x divide-gray-200">
                <td colspan="100%" class="whitespace-nowrap p-4 text-sm text-gray-800 font-bold bg-gray-50">
                    SETTIMANA {{ $week->week }}
                </td>
            </tr>
            @foreach($week->workout_days as $day)
                <tr class="divide-x divide-gray-200">
                    <td colspan="100%" class="whitespace-nowrap p-4 text-sm text-gray-700 font-semibold pl-8 uppercase">
                        {{ config('fitmatch.days.'.$day->day) }}
                    </td>
                </tr>
                @foreach($day->workout_sets as $set)
                    <tr class="divide-x divide-gray-200">
                        <td class="whitespace-nowrap p-4 text-sm text-gray-500 font-semibold pl-12"
                            style="color: {{config('fitmatch.workout.colors.'. $loop->index % count(config('fitmatch.workout.colors')))}}"
                        >
                            SET {{ str_pad($loop->iteration, 2, "0", STR_PAD_LEFT) }}
                        </td>
                        <td class="whitespace-nowrap min-w-[110px] p-4 text-sm text-center text-gray-500 font-semibold">
                            RIPETIZIONI
                        </td>
                        <td class="whitespace-nowrap min-w-[110px] p-4 text-sm text-center text-gray-500 font-semibold">
                            CARICO
                        </td>
                    </tr>
                    @foreach($set->workout_series as $serie)
                        @foreach($serie->items as $item)
                            <tr class="divide-x divide-gray-200">
                                @switch($item->item_type)
                                    @case('App\Models\Exercise')
                                        @php
                                            $exercise = \App\Models\Exercise::find($item->item_id);
                                            $intensity = \App\Models\Intensity::find($item->intensity_id)
                                        @endphp
                                        <td class="whitespace-nowrap p-4 text-sm text-gray-500 pl-12">
                                            <p class="italic text-xs text-gray-400">{{ $intensity->name }}</p>
                                            <p>{{$exercise->name}}</p>
                                            @if($item->notes)
                                                <hr class="my-1">
                                                <h6 class="font-semibold">Note aggiuntive:</h6>
                                                <p>{{ $item->notes }}</p>
                                            @endif
                                        </td>
                                        @if(isset($serie->items[$loop->index + 1]) && $serie->items[$loop->index + 1]->item_type === 'App\Models\Repetition')
                                            @php
                                                $repetition = \App\Models\Repetition::find($serie->items[$loop->index + 1]->item_id)
                                            @endphp
                                            <td class="whitespace-nowrap min-w-[110px] align-top p-4 pt-8 text-sm text-center text-gray-500">
                                                <p>{{$repetition->quantity}}</p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap min-w-[110px] align-top p-4 pt-8 text-sm text-center text-gray-500">
                                                <p>-</p>
                                            </td>
                                        @endif
                                        @if(isset($serie->items[$loop->index + 2]) && $serie->items[$loop->index + 2]->item_type === 'App\Models\Cargo')
                                            @php
                                                $cargo = \App\Models\Repetition::find($serie->items[$loop->index + 2]->item_id)
                                            @endphp
                                            <td class="whitespace-nowrap min-w-[110px] align-top p-4 pt-8 text-sm text-center text-gray-500">
                                                <p>{{$cargo->quantity}}</p>
                                            </td>
                                        @else
                                            <td class="whitespace-nowrap min-w-[110px] align-top p-4 pt-8 text-sm text-center text-gray-500">
                                                <p>-</p>
                                            </td>
                                        @endif
                                        @break
                                    @case('App\Models\Recovery')
                                        @php
                                            $recovery = \App\Models\Recovery::find($item->item_id)
                                        @endphp
                                        <td class="whitespace-nowrap p-4 text-sm text-gray-500 pl-12">
                                            <p class="font-semibold">
                                                Recupero -- {{ $recovery->quantity->format('i:s') }}
                                            </p>
                                        </td>
                                        @break
                                @endswitch
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
