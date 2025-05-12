<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>

    <div class="input-group">
        <span class="input-group-text">
            <i class="{{ $icon }}"></i>
        </span>
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            class="form-control @error($name) is-invalid @enderror"
            {{ $attributes }}
        >
    </div>

    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
