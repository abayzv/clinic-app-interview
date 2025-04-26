<div class="flex justify-end items-center gap-2">
    <button type="button" class="text-green-600 hover:text-green-900 flex gap-1 items-center bg-green-100 p-1 rounded"
        title="QR Code" onclick="openQrModal('{{ $product->sku }}', `{!! htmlspecialchars($product->qrcode) !!}`)">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor"
                d="M3 11h8V3H3zm2-6h4v4H5zM3 21h8v-8H3zm2-6h4v4H5zm8-12v8h8V3zm6 6h-4V5h4zm-5.99 4h2v2h-2zm2 2h2v2h-2zm-2 2h2v2h-2zm4 0h2v2h-2zm2 2h2v2h-2zm-4 0h2v2h-2zm2-6h2v2h-2zm2 2h2v2h-2z" />
        </svg>
        QR Code
    </button>

    <x-action-buttons edit-route="products.edit" delete-route="products.destroy" :item-name="'Product ' . $product->name"
        :item-id="$product->id"></x-action-buttons>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    let currentSku = '';

    function openQrModal(sku, qrcodeHtml) {
        currentSku = sku;
        document.getElementById('qrTitle').innerText = 'QR Code for ' + sku;
        document.getElementById('qrContainer').innerHTML = qrcodeHtml;
        openModal('qrModal');
    }

    function downloadQrCode() {
        const qr = document.getElementById('qrContainer').querySelector('svg');
        if (!qr) {
            alert('QR code not found.');
            return;
        }

        const serializer = new XMLSerializer();
        const svgStr = serializer.serializeToString(qr);
        const blob = new Blob([svgStr], {
            type: 'image/svg+xml'
        });
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = currentSku + '.svg';
        a.click();
        URL.revokeObjectURL(url);
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.classList.add('hidden');
        }
    }
</script>
