---
to: resources/views/<%= resource %>/index.blade.php
---

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('<%= resource.charAt(0).toUpperCase() + resource.slice(1) %>') }}
            </h2>

            <button onclick="openModal('create<%= resource.charAt(0).toUpperCase() + resource.slice(1) %>Modal')"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                + Add <%= resource.charAt(0).toUpperCase() + resource.slice(1) %>
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-data-table class="w-full" :items="$<%= resource %>" :columns="[
                        'created_at' => 'Created At',
                    ]" paginated>
                        @slot('actions', function ($item) {
                            return view('components.action-buttons', [
                            'editRoute' => '<%= resource %>.edit',
                            'deleteRoute' => '<%= resource %>.destroy',
                            'itemId' => $item->id,
                            'itemName' => '<%= resource.slice(0, -1) %> ' . $item->name,
                            'modalId' => 'deleteModal-' . uniqId(),
                            ]);
                            })
                        </x-data-table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal-form modal-id="create<%= resource.charAt(0).toUpperCase() + resource.slice(1) %>Modal"
            title="Create <%= resource.charAt(0).toUpperCase() + resource.slice(1) %>"
            action="{{ route('<%= resource %>.store') }}"
            method="POST">
            @slot('body')
                @include('<%= resource %>.partials.create')
            @endslot
        </x-modal-form>
</x-app-layout>
