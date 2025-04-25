<div id="{{ $modalId }}"
    class="modal hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="modal-content relative top-20 mx-auto border max-w-2xl shadow-lg rounded-md bg-white">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900 p-5 border-b">{{ $title }}</h3>

            <form action="{{ $action }}" method="POST" class="mt-4 px-5">
                @csrf
                @if (strtoupper($method) !== 'POST')
                    @method($method)
                @endif

                @if (isset($item))
                    {!! $body($item) !!}
                @else
                    {!! $body !!}
                @endif

                <div class="flex justify-end gap-2 py-5">
                    <button type="button" onclick="closeModal('{{ $modalId }}')"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        {{ $submitText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.querySelector(`#${modalId} form`).reset();
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.classList.add('hidden');
            event.target.querySelector('form').reset();
        }
    }
</script>
