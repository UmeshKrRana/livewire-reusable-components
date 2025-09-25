<div class="overflow-x-auto border rounded-xl shadow-md">

    <table class="w-full table-auto text-sm text-left">
        <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-semibold border-b">

            <tr>
                @foreach ($columns as $column)
                    <th class="p-4 {{ $column['class'] ?? '' }}">{{ $column['label'] }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>

            {{-- Table Row --}}
            @forelse ($this->rows as $row)
                <tr class="hover:bg-gray-50 transition border-t">

                    {{-- Table Column --}}
                    @foreach ($columns as $column)
                        <td class="p-4">
                            @switch($column['type'])
                                {{-- Index --}}
                                @case('index')
                                    {{ $loop->parent->iteration }}
                                @break

                                {{-- Field --}}
                                @case('field')
                                    {{ data_get($row, $column['field']) }}
                                @break

                                {{-- Date --}}
                                @case('date')
                                    @if (isset($column['format']) && $column['format'] === 'diffForHumans')
                                        {{ data_get($row, $column['field'])?->diffForHumans() }}
                                    @endif
                                @break

                                {{-- Actions --}}
                                @case('actions')
                                    <div class="flex justify-center gap-1">
                                        @foreach ($column['actions'] as $action)
                                            @php
                                                $action = array_merge($action, ['rowId' => $row->id]);
                                            @endphp

                                            <flux:button wire:click="actionClickHandler({{ json_encode($action) }})"
                                                class="cursor-pointer {{ $action['class'] ?? '' }}" icon="{{ $action['icon'] }}"
                                                color="{{ $action['color'] }}" variant="{{ $action['variant'] }}">
                                            </flux:button>
                                        @endforeach

                                    </div>
                                @break

                                @default
                            @endswitch
                        </td>
                    @endforeach
                </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) }}" class="p-6 text-center">
                            <flux:text class="flex items-center justify-center text-red-500">
                                <flux:icon.exclamation-triangle class="mr-2" /> No data found!
                            </flux:text>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($this->rows->hasPages())
            <div class="p-4 border-t bg-gray-50">
                {{ $this->rows->links() }}
            </div>
        @endif

    </div>
