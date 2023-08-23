@props(['value'])

<div>
    @if(is_double($value))
    {{ $value }} f cfa
    @else
    {{$value}}
    @endif
</div>
