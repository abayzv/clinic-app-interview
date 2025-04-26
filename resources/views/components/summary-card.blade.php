<div class="bg-white p-4 rounded-xl shadow-sm">
    <div class="text-gray-500 text-sm mb-1 uppercase tracking-wide">
        {{ $name }}
    </div>
    <div class="text-2xl font-bold text-gray-800">
        {{ is_numeric($value) ? number_format($value, 0, ',', '.') : $value }}
    </div>
</div>
