@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'options' => []
])

<div class="form-group mb-3">
    <label class="mb-1" for="{{ $name }}">{{ $label }}</label>

    <div class="@error($name) is-invalid @enderror">
        @foreach($options as $option)
            <div class="form-check form-check-inline" role="button">
                <input
                    class="form-check-input {{ $value === $option["value"] ? 'checked' : '' }}"
                    type="radio" name="{{ $name }}"
                    role="button"
                    id="{{ $name ."_" .$option["value"] }}"
                    value="{{ $option["value"] }}"
                    {{ $value === $option['value'] ? 'checked' : '' }}
                />

                <label class="form-check-label" for="{{ $name ."_" .$option["value"] }}" role="button">
                    {{ $option["label"] }}
                </label>
            </div>
        @endforeach
    </div>

    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
