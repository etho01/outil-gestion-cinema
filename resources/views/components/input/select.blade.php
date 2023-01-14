<div @isset($class) class="{{ $class }}" @endisset>
    @if (isset($label))
        <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    @endif
    <select name="{{$name}}" id="{{ $name }}" class="form-select">
        <option value="0" selected>---</option>
        @foreach ($elements as $element)
            <option value="{{$element->id}}" 
                @isset($record)   @if ($element->id == $defaultValue) selected @endif @endisset>{{$element->nom}}</option>
        @endforeach
    </select>
</div>