<div @isset($class) class="{{ $class }}" @endisset>
    @if (isset($label))
        <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    @endif
    <input type="text" class="form-control" 
        name="{{$name}}" id="{{ $name }}"
        @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
        @isset($champLivewire) wire:model="{{ $champLivewire }}" @endisset
        @isset($value) {{ $value }} @endisset>
</div>