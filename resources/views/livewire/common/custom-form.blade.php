{{-- Common form  --}}
<form wire:submit="handleSubmit" class="space-y-6">

    {{-- Rendering form fields --}}
    @foreach ($fields['fields'] as $field)
        {{-- Condition for handling different fields --}}
        @switch($field['type'])
            {{-- 1. For input --}}
            @case('input')
                <flux:input :disabled="$isView" wire:model.live="formData.{{ $field['name'] }}" :label="$field['label']"
                    :placeholder="$field['placeholder']" />
            @break

            {{-- 2. For select --}}
            @case('select')
                <flux:select :disabled="$isView" wire:model.live="formData.{{ $field['name'] }}" :label="$field['label']"
                    :placeholder="$field['placeholder'] ?? 'Select option'">
                    @foreach ($field['options'] as $value => $label)
                        <flux:select.option :value="$value">{{ $label }}</flux:select.option>
                    @endforeach
                </flux:select>
            @break

            {{-- 3. For Textarea --}}
            @case('textarea')
                <flux:textarea :disabled="$isView" wire:model.live="formData.{{ $field['name'] }}" :label="$field['label']"
                    :placeholder="$field['placeholder']" :rows="$field['rows'] ?? 2" />
            @break

            {{-- 4. For file|image --}}
            @case('image')
            @case('file')
                @if (!$isView)
                    <flux:input wire:model.live="formData.{{ $field['name'] }}" type="file" :label="$field['label']"
                        :accept="$field['accept']"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:textsm file:font-semibold file:bg-indigo-100 file:text-indigo-700 hover:file:bgindigo-200" />

                    {{-- Info text --}}
                    @if (isset($field['info']))
                        <flux:text class="flex text-gray-500 items-center mt-2" size="sm"> <flux:icon.information-circle
                                class="mr-1" variant="micro" /> {{ $field['info'] }}
                        </flux:text>
                    @endif
                @endif

                {{-- Image preview --}}
                @if (!empty($formData[$field['name']]))
                    @php
                        $file = $formData[$field['name']];
                        $isTemp = $file instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

                        // Only images
                        $isImage = $isTemp
                            ? str_starts_with($file->getMimeType(), 'image')
                            : preg_match('/\.(png|jpe?g|gif|svg)$/i', $file);

                        $url = $isImage ? ($isTemp ? $file->temporaryUrl() : asset('storage/' . $file)) : null;

                    @endphp

                    <div class="mt-2">
                        @if ($isImage)
                            <img src="{{ $url }}" alt="Image preview" class="w-200 object-cover rounded-lg" />
                        @else
                            <a href="{{ $url }}" target="_blank"
                                class="text-sm text-gray-600 underline">{{ $file }} </a>
                        @endif
                    </div>
                @endif
            @break

            @default
        @endswitch
    @endforeach

    <flux:separator variant="subtle" />

    {{-- Render buttons --}}
    <div class="flex items-center justify-end gap-2 mt-4">
        @foreach ($fields['buttons'] as $button)
            @if (!$isView)
                <flux:button :type="$button['type']" :icon="$button['icon']" :variant="$button['variant']"
                    :color="$button['color']" class="cursor-pointer">
                    {{ isset($formFieldData['id']) ? 'Update' : $button['label'] }}</flux:button>
            @endif
        @endforeach
    </div>
</form>
