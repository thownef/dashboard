@props([
    'name' => '',
    'type' => 'text',
    'label' => '',
    'value' => '',
    'labelClass' => '',
    'class' => '',
    'accept' => '',
    'isRequired' => false,
    'readonly' => false,
    'onchange'=> ''
])

<div class="form-group mb-3">
    @if($name)
        <label class="{{ $labelClass }}" for="{{ $name }}">
            {{ $label }}

            @if($isRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        accept="{{ $accept }}"
        class="@if($readonly) form-control-plaintext @else form-control @endif {{ $class }} @error($name) is-invalid @enderror"
        @if($value) value="{{ $value }}" @endif
        @if($onchange) onchange="{{ $onchange }}" @endif
        @if($readonly) readonly @endif
    />

    @error($name)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
