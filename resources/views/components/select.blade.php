<div class="form-floating col-sm-{{ $col }} pb-3">
    <select id="{{ $name }}"
            class="select-multiple @error($name) is-invalid @enderror"
            name="{{ $name }}[]"
            multiple="multiple"
    >
        @foreach($options as $key => $value)
            <option {{ in_array($key, $selected) ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
        @endforeach

    </select>

    <label for="{{ $name }}">{{ $label }}</label>

    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
