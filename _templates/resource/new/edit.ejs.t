---
to: resources/views/<%= resource %>/edit.blade.php
---
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit <%= resource.charAt(0).toUpperCase() + resource.slice(1) %>') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit <%= resource.charAt(0).toUpperCase() + resource.slice(1) %> ') . $<%= resource.slice(0, -1) %>->name }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Update current <%= resource.slice(0, -1) %> item.') }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('<%= resource %>.update', $<%= resource.slice(0, -1) %>) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <%
                        const fieldsArr = fields.split(',').map(f => {
                        const [name, type] = f.split(':').map(x => x.trim());
                        return { name, type };
                        });

                        const label = (str) => str.charAt(0).toUpperCase() + str.slice(1).replace(/_/g, ' ');
                        const varName = resource.slice(0, -1); // singular
                        %>

                        <% fieldsArr.forEach(({ name, type }) => { %>
                        <div>
                        <x-input-label for="<%= name %>" :value="__(' <%= label(name) %>')" />
                        <% if (type === 'select') { %>
                            <x-select id="<%= name %>" name="<%= name %>" class="mt-1 block w-full" required>
                            <option value="">Select a <%= label(name) %></option>
                            @foreach ($<%= name.replace('_id', 's') %> as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('<%= name %>', $<%= varName %>-><%= name %>) == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                            </x-select>
                        <% } else { %>
                            <x-text-input id="<%= name %>" name="<%= name %>" type="<%= type %>" class="mt-1 block w-full"
                            :value="old('<%= name %>', $<%= varName %>-><%= name %>)" required />
                        <% } %>
                        <x-input-error class="mt-2" :messages="$errors->get('<%= name %>')" />
                        </div>
                        <% }); %>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
