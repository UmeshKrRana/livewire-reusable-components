<div>

    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Gallery Management') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage image gallery from here') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- form --}}
    <div class="space-y-10">

        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-2xl p-6">

            <form wire:submit="upload" class="space-y-6">

                <div>
                    <flux:input type="file" label="Upload Image(s)" wire:model.live="photos" multiple accept="image/*" />
                </div>


                {{-- Submit --}}
                <flux:button type="submit" color="blue" variant="primary" class="cursor-pointer">Upload</flux:button>
            </form>
        </div>

    </div>

</div>
