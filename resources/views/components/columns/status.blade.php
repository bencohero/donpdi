@props([
'value'
])

<div class="flex">
    <div @class([ 'text-white rounded-xl px-2 uppercase font-bold text-xs' , 'bg-red-500'=> $value === 'failed',
        'bg-green-500' => $value === 'completed',
        'bg-gray-600' => $value === 'pending',
        'bg-red-500' => $value === 'canceled',
        'bg-red-400' => $value === 'failed'

        ])>
        {{ $value }}
    </div>
</div>