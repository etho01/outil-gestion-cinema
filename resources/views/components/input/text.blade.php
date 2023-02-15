<div @isset($class) class="{{ $class }}" @endisset>
    @if (isset($label))
        <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    @endif
    <div class="input-group">
        @isset($inputGroupBefore) {{ $inputGroupBefore }} @endisset
        <input type="@if(isset($type)){{$type}}@else text @endif" class="form-control" 
            name="{{$name}}" id="{{ $name }}"
            @isset($change)  wire:change="{{$change}}"    @endisset
            @isset($placeholder) placeholder="{{ $placeholder }}" @endisset
            @isset($champLivewire) wire:model="{{ $champLivewire }}" @endisset
            @isset($value) value="{{$value }}" @endisset>
        @isset($inputGroupAfter) {{ $inputGroupAfter }} @endisset
    </div>
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>