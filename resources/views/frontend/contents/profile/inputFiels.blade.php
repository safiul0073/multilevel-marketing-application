<div class="w-full">
    <input
    id="{{ $name }}"
    type="{{ isset($type) ? $type : 'text'}}"
    class="@error($name) has-error @enderror w-full h-12 my-1 rounded-md outline-none px-4 text-gray-700 border-[1px] border-indigo-700"
    name="{{ $name }}"
    value="{{ $value ? $value : old($name)  }}"
    {{ $isUpdated ? "readonly" : ""}}
    autofocus />
    @error($name)
    <span class="error-message" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
