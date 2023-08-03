@props(['event' => 'itemSelected', 'to' => null, 'disabled' => false, 'required' => false, 'name', 'label' => false, 'hint' => false, 'append' => false, 'prepend' => false, 'iconColor' => 'text-gray-800'])
@php
    $n = $attributes->wire('model')->value() ?: $name;
    $slug = $attributes->wire('model')->value() ?: $n;
    $inputClass = 'appearance-none w-full rounded sm:text-sm focus:ring focus:ring-opacity-50';
@endphp
@error($slug)
@php
    $inputClass .= ' pr-11 border-red-300 focus:outline-none text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500';
@endphp
@else
    @php
        $inputClass .= ' border-gray-300 focus:border-indigo-300 focus:ring-indigo-200';
    @endphp
    @enderror
    @if($prepend)
        @php
            $inputClass .= ' pl-11';
        @endphp
    @endif
    @if($append)
        @php
            $inputClass .= ' pr-11';
        @endphp
    @endif

    <div
        x-data="{
			active: false,
			query: '',
			selectedItemIndex: '',
			selectedItemTitle: '',
			title: @js($title),
			subtitle: @js($subtitle),
			items: @js($items),
			get filteredItems() {
				if (this.query === '') {
					return this.items;
				}
				@if($title && !$subtitle)
                    return this.items.filter(item => item.{{$title}}.toLowerCase().includes(this.query.toLowerCase()))
				@endif
				@if($title && $subtitle)
                    return this.items.filter(item => item.{{$title}}.toLowerCase().includes(this.query.toLowerCase()) || item.{{$subtitle}}.toLowerCase().includes(this.query.toLowerCase()))
				@endif
			},
			reset() {
                this.query = '';
			},
			selectNextItem() {
                if (this.selectedItemIndex === '') {
					this.selectedItemIndex = 0;
				} else {
					this.selectedItemIndex++;
				}

				if (this.selectedItemIndex === this.filteredItems.length) {
					this.selectedItemIndex = 0;
				}

				this.focusSelectedItem();
			},
			selectPreviousItem() {
			if (this.selectedItemIndex === '') {
					this.selectedItemIndex = this.filteredItems.length - 1;
				} else {
					this.selectedItemIndex--;
				}

				if (this.selectedItemIndex < 0) {
					this.selectedItemIndex = this.filteredItems.length - 1;
				}

				this.focusSelectedItem();
			},
			focusSelectedItem() {
                this.$refs.items.children[this.selectedItemIndex + 1].scrollIntoView({ block: 'nearest' })
            },
            selectItemByIndex() {
            	let item = this.filteredItems[this.selectedItemIndex]
            	$wire.test(item.{{$return}})
            	this.query = item.{{$title}}
            	this.selectedItemTitle = item.{{$title}}
            	this.active = false
            },
			close(focusAfter) {
                if (! this.active) return

				this.active = false

                focusAfter && focusAfter.focus()
            },
		}"
        x-init="
			$watch('active', (value) => {
				let index = items.findIndex(item => item.{{$title}} === selectedItemTitle);
				if(value) {
					query = ''
					selectedItemIndex = index
				} else {
					query = selectedItemTitle
				}
			})
			$watch('query', (value, oldValue) => {
				if(value === '') {
					active = true
					selectedItemIndex = ''
				}
				if(value !== oldValue) {
					selectedItemIndex = ''
				}
			})
			$watch('selectedItemIndex', (value) => {
				if(value) {
					$refs.input.focus();
				}
			})
		"
        {{--		x-on:keydown.escape.prevent.stop="close($refs.input)"--}}
        {{--		x-on:focusin.window="! $refs.items.contains($event.target) && close()"--}}
        x-id="['dropdown']"
    >
        @if($label || isset($action))
            <div class="flex items-center justify-between">
                @if ($label)
                    <x-input-label :for="$slug" :required="$required">{{ $label }}</x-input-label>
                @endif
                @isset($action)
                    {{ $action }}
                @endisset
            </div>
        @endif
        <div class="relative @if($label || isset($action)) mt-1 @endif">
            @if($prepend)
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <x-icon name="{{$prepend}}" class="{{ $iconColor }} w-4 h-4"></x-icon>
                </div>
            @endif
            <input
                x-ref="input"
                x-model="query"
                x-on:keyup.down="selectNextItem"
                x-on:keyup.up="selectPreviousItem"
                x-on:focus="$nextTick(() => {reset(); active = true})"
                x-on:click.outside="active = false"
                x-on:keyup.enter.prevent="selectItemByIndex()"
                x-on:keydown.tab="selectedItemTitle || active ? active = false : active = true"
                type="text"
                wire:ignore
                {{ $attributes->merge(['class' => $inputClass]) }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $required ? 'required' : '' }}
                name="{{ $slug }}"
                id="{{ $slug }}"
                :aria-expanded="active"
                :aria-controls="$id('dropdown')"
            />
            @error($slug)
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <x-icon
                    name="heroicon-o-exclamation-circle"
                    class="w-4 h-4 text-red-500"
                ></x-icon>
            </div>
            @else
                @if($append)
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <x-icon name="{{$append}}" class="{{ $iconColor }} w-4 h-4"></x-icon>
                    </div>
                @endif
                @enderror
                <ul
                    x-cloak
                    x-ref="items"
                    x-show="active && filteredItems.length > 0"
                    x-transition
                    class="absolute z-10 mt-2 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                    tabindex="-1">
                    <template x-for="(item, index) in filteredItems" :key="'item-'+item.id">
                        <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9 hover:cursor-pointer hover:bg-gray-200"
                            :class="{ 'bg-gray-200': index === selectedItemIndex }"
                            x-on:click.stop="selectItemByIndex()"
                            x-on:mouseenter="selectedItemIndex = index"
                        >
                            <p class="truncate"
                               :class="{ 'font-semibold': index === selectedItemIndex }"
                               x-text="item.{{$title}}"></p>
                            @if($subtitle)
                                <p class="text-xs text-gray-500" x-text="item.{{$subtitle}}"></p>
                            @endif
                            <template x-if="index === selectedItemIndex">
                                <div class="text-indigo-600 absolute inset-y-0 right-0 flex items-center pr-4">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </template>
                        </li>
                    </template>
                </ul>
        </div>
        @if($hint)
            <p class="mt-1 text-xs text-gray-500">{{ $hint }}</p>
        @endif
        <x-input-error :messages="$errors->get($slug)"></x-input-error>
    </div>
