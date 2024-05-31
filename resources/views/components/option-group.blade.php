@props([
    'id' => '',
    'name' => '',
    'type' => 'text',
    'label' => '',
    'value' => "none",
    'options' => [],
    'keyOptions' => ['value' => 'value', 'label' => 'label'],
    'placeHolder' => "",
    'isRequired' => false,
    'disabled' => false
])

<div class="form-group">
    @if($name)
        <label for="{{ $name }}">
            {{ $label }}

            @if($isRequired)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
   
    <div class="form-group mb-3">
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            type="{{ $type }}"
            @if($disabled) disabled @endif
            class="form-select @error($name) is-invalid @enderror"
        >
            <option value="null" selected disabled hidden>{{ $placeHolder }}</option>
            @foreach($options as $option)
                <option
                    value="{{ $option[$keyOptions['value']] }}"
                    @if($option[$keyOptions['value']] === $value) selected @endif
                >
                    {{ $option[$keyOptions['label']] }}
                </option>
            @endforeach
        </select>
        @error($name)
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
