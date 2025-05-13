<!-- components/confirm-modal.blade.php -->
<div
  x-data="{ open: false, action: null }"
  x-show="open"
  @open-delete-confirm.window="open = true; action = $event.detail.action"
  class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
  style="display: none;"
>
  <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full text-center">
    <div class="text-4xl text-black mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 5a7 7 0 100 14 7 7 0 000-14z" />
      </svg>
    </div>
    <p class="mb-6 text-lg font-semibold">Apakah anda yakin ingin menghapus data ini?</p>
    <div class="flex justify-center gap-4">
      <button @click="action.submit(); open = false"
              class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Ya
      </button>
      <button @click="open = false"
              class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Tidak
      </button>
    </div>
  </div>
</div>
