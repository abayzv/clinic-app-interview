<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-data-table class="w-full" :items="$categories" :columns="[
                        'name' => 'Nama',
                        'created_at' => 'Tanggal Daftar',
                    ]" paginated>
                        @slot('actions', function ($category) {
                            return view('components.action-buttons', [
                            'editRoute' => 'categories.index',
                            'deleteRoute' => 'categories.index',
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
    </x-app-layout>
