<div>

    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users Management') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage users from here') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Add user --}}
    <div class="text-end mb-4">
        <flux:button wire:click="$dispatch('open-modal', {modalName: 'user-form-modal', actionType: 'create'})"
            variant="primary" color="indigo" icon="plus-circle" class="cursor-pointer">Add User</flux:button>
    </div>

    {{-- User form component --}}
    <livewire:users.user-form />

    {{-- Common Table Component --}}
    <livewire:common.custom-table :columns="$tableColumns" :model-class="$modelClass" :per-page="$perPage" :order-by-key="$orderByKey"
        :sort-order="$sortOrder" actionEvent="users-table-action" />
</div>
