<div class="col-8 offset-2">
    <div>
        <label for="{{ $id }}" class="form-label fs-5">{{ $label }}</label>
        <textarea class="form-control" id="{{ $id }}" name="{{ $name }}" rows="8">
            {{ old($name) ?? $slot }}
        </textarea>
    </div>
    <div @class([
        'text-danger fs-6 mt-2' => $errors->has($name),
    ])>
        @error($name)
            {{ $message }}
        @enderror
    </div>
</div>
<div class="col-8 my-2 text-sm text-secondary">
    @if ($help)
        <p>{{ $help }}</p>
    @endif
</div>
