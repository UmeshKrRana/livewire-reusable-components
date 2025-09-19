<div>

    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users Management') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage users from here') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Common Table Component --}}
    <livewire:common.custom-table :columns="$tableColumns" :model-class="$modelClass" :per-page="$perPage" :order-by-key="$orderByKey"
        :sort-order="$sortOrder" />
</div>
