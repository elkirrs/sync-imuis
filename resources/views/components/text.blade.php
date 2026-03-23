<div class="col-sm-{{ $col }} pb-3">
    <div class="form-floating">
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            value="{{ old($name, $value) ?? null }}"
            placeholder="{{ $label }}"
        >
        <label for="{{ $name }}">{{ __($label) }}</label>

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
