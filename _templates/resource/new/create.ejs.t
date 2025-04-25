---
to: resources/views/<%= resource %>/partials/create.blade.php
---
<div class="space-y-6">
<%
  const fieldPairs = fields.split(',').map(pair => {
    const [name, typeRaw] = pair.split(':');
    return { name: name.trim(), type: typeRaw.trim() };
  });

  const label = (str) => str.charAt(0).toUpperCase() + str.slice(1).replace(/_/g, ' ');
%>

<% fieldPairs.forEach(({ name, type }) => { %>
  <!-- <%= label(name) %> -->
  <div class="flex flex-col items-start">
    <x-input-label for="<%= name %>" :value="__(' <%= label(name) %>')" />

    <% if (type === 'select') { %>
      <x-select id="<%= name %>" name="<%= name %>" class="mt-1 block w-full" required>
        <option value="">Select a <%= label(name) %></option>
        @foreach ($<%= name.replace('_id', 's') %> as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </x-select>
    <% } else { %>
      <x-text-input id="<%= name %>" name="<%= name %>" type="<%= type %>" class="mt-1 block w-full" required />
    <% } %>

    <x-input-error class="mt-2" :messages="$errors->get('<%= name %>')" />
  </div>
<% }); %>
</div>
