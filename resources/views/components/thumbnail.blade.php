<div class="col-8 offset-2">
    <label for="thumbnail" class="form-label fs-5">{{ $label }}</label>
    <input type="file" name="{{ $name }}" id="thumbnail" class="custom-form-control">
    <div @class([
        'text-danger fs-6 mt-2' => $errors->has($name),
    ])>
        @error($name)
            {{ $message }}
        @enderror
    </div>
</div>
<div class="col-8 offset-2 my-2 text-sm text-secondary">
    @if ($help)
        <p>{{ $help }}</p>
    @endif
</div>
<div class="col-8 offset-2 my-2 text-sm text-secondary">
    @if ($type === 'file' && $value)
        <p class="text-secondary">Fichier actuel : </br>
            {{ $value }}
        </p>
        @if ($isImage())
            <img src="{{ asset('storage/' . $value) }}" alt="Image {{ $value }}">
        @endif
    @endif
</div>
