<div @isset($class) class="{{ $class }}" @endisset>
    @if (isset($label))
        <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    @endif
    <select name="{{$name}}" id="{{ $name }}" class="form-select" 
    @isset($champLivewire)  wire:model="{{ $champLivewire }}" @endisset 
    @isset($multiple) multiple @endisset
    @isset($change)  wire:change="{{$change}}"    @endisset
    @isset($disable) @if ($disable == true) disabled  @endif @endisset
    >

        <option value="" selected>---</option>
        @foreach ($elements as $element)
            <option value="{{$element->id}}" 
                @isset($defaultValue)   @if ($element->id == $defaultValue) selected @endif @endisset>{{$element->nom}}</option>
        @endforeach
    </select>
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>