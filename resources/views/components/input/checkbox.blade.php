<div>
    <input type="checkbox" class="form-check-input" id="{{ $prefix.$id }}"
     name="{{ $prefix.$id }}" @if($enable) checked @endif>
    <label for="{{ $prefix.$id }}" class="form-check-label">{{ $nom }}</label>
</div>