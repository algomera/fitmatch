<div
    class="m-1 select-none border border-b-4 border-b-fit-magenta rounded-md overflow-hidden w-56 min-h-[230px] shrink-0">
    <div class="flex flex-col w-full h-full items-start justify-center bg-white space-y-1.5">
        <div class="flex w-full items-center flex-1 p-4 border-b">
            <h4 class="text-2xl font-bold truncate">Ripetizioni</h4>
        </div>
        <div class="flex w-full items-center justify-between flex-1 p-4">
            <h4 class="text-2xl font-bold truncate">{{ $item->quantity }}</h4>
            <div class="flex items-center space-x-2">
                <div wire:click="decrement"
                     class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full {{ $item->quantity <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:cursor-pointer' }}">
                    <x-heroicon-o-minus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-minus>
                </div>
                <div wire:click="increment"
                     class="flex items-center justify-center h-6 w-6 border border-fit-dark-gray rounded-full hover:cursor-pointer">
                    <x-heroicon-o-plus class="h-4 w-4 text-fit-dark-gray"></x-heroicon-o-plus>
                </div>
            </div>
        </div>
        <div class="border-t w-full flex items-center justify-between p-4">
            <div class="flex space-x-2">
                <x-heroicon-o-ellipsis-horizontal
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-ellipsis-horizontal>
                <x-heroicon-o-queue-list
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-queue-list>
            </div>
            <div class="flex space-x-2">
                <x-heroicon-o-trash
                    wire:click="delete"
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-trash>
                <x-heroicon-o-square-2-stack
                    class="h-4 w-4 hover:text-fit-magenta hover:cursor-pointer"></x-heroicon-o-square-2-stack>
            </div>
        </div>
    </div>
</div>
