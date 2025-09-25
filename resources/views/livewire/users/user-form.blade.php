{{-- Create user modal --}}
<flux:modal name="user-form-modal" class="md:w-[32rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">
                {{ $isView ? 'User Detail' : (isset($formData['id']) ? 'Update User' : 'Create User') }}</flux:heading>
            <flux:text class="mt-2">Create a new user by filling up the form below.</flux:text>
        </div>

        <flux:separator variant="subtle" />

        {{-- Common form component --}}
        <livewire:common.custom-form :fields="$formFields" submitEvent="save-user-form" :form-field-data="$formData" :key="($formData['id'] ?? 'new') . ($isView ? '-view' : '-edit')"
            :isView="$isView" />
    </div>
</flux:modal>
