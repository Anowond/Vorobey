<div class="col-8 offset-2">
    <div>
        <label for="{{ $id }}" class="form-label fs-5">{{ $label }}</label>
        <select class="form-select" id="{{ $id }}" name="{{ $name . ($multiple ? '[]' : '') }}"
            @if ($multiple) multiple="true" @endif>
            @foreach ($list as $item)
                <option value="{{ $item->{$optionsValues} }}"
                    {{ ($valueIsCollection ? $value->contains($item->{$optionsValues}) : $item->{$optionsValues} == $value) ? 'selected' : '' }}>
                    {{ $item->{$optionsTexts} }}
                </option>
            @endforeach
        </select>
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
