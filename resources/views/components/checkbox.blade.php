<div class="pb-3 form-check {{ $isSwitch ? "form-switch" : "" }}">

    <input type="hidden" name="{{ $name }}" value="0">

    <input
        class="form-check-input"
        type="checkbox"
        role="{{ $isSwitch ? 'switch'  : ''}}"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name ?? $value) ?? $value }}"
        {{ old($name, $checked) ? 'checked' : '' }}
    >
    <label class="form-check-label "
           for="{{ $name }}"
    >{{ $label }}</label>
</div>
