@section('title', 'Categories')

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>

            <button onclick="openModal('createCategoryModal')"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                + Add Category
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-data-table class="w-full" :items="$categories" :columns="[
                        'name' => 'Name',
                        'created_at' => 'Created At',
                    ]" paginated>
                        @slot('actions', function ($category) {
                            return view('components.action-buttons', [
                            'editRoute' => 'categories.edit',
                            'deleteRoute' => 'categories.destroy',
                            'itemId' => $category->id,
                            'itemName' => 'category ' . $category->name,
                            'modalId' => 'deleteModal-' . uniqId(),
                            ]);
                            })
                        </x-data-table>
                    </div>
                </div>
            </div>
        </div>

        <x-modal-form modal-id="createCategoryModal" title="Create Categories" action="{{ route('categories.store') }}"
            method="POST">
            @slot('body')
                @include('categories.partials.create')
            @endslot
        </x-modal-form>
    </x-app-layout>
