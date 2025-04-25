<div class="overflow-hidden rounded-lg">
    <table class="{{ $class }}">
        <thead class="bg-gray-50">
            <tr>
                @foreach ($columns as $key => $label)
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $label }}
                    </th>
                @endforeach

                @if ($actions)
                    <th scope="col"
                        class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($items as $item)
                <tr>
                    @foreach ($columns as $key => $label)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ data_get($item, $key) }}
                        </td>
                    @endforeach

                    @if ($actions)
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            {!! $actions($item) !!}
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + ($actions ? 1 : 0) }}"
                        class="px-6 py-4 text-center text-sm text-gray-500">
                        {{ $emptyMessage }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($paginated && $items instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $items->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>
