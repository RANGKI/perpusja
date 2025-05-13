@if (session('success'))
    <div class="flex justify-center mb-6">
        <div class="bg-white border border-green-400 rounded-xl shadow-lg px-8 py-6 max-w-md w-full text-center">
            <div class="flex justify-center mb-4">
                <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2l4 -4m5 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-green-700 mb-2">Berhasil!</h2>
            <p class="text-gray-700">{{ session('success') }}</p>
        </div>
    </div>
@endif
