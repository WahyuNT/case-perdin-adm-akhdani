

<label for="{{ $inputId }}" class="text-sm text-gray-500">{{ $label }}</label>
<input id="{{ $inputId }}" wire:model.defer="{{ $wireModel }}" type="{{ $type }}"
    class="bg-gray-100 w-full border-0 p-2 mt-1 rounded-lg focus:outline-gray-300" 
    placeholder="{{ $placeholder }}">

@error($wireModel)
    <div class="text-red-500 text-sm">{{ $message }}</div>
@enderror