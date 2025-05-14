@if ($errors->any())
    <div class="flex justify-center mb-6">
        <div class="bg-white border border-red-400 rounded-xl shadow-lg px-8 py-6 max-w-md w-full text-center">
            <div class="flex justify-center mb-4">
                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.054 0 1.58-1.14.894-2L13.414 4c-.667-1-2.161-1-2.828 0L3.172 17c-.686.86-.16 2 .894 2z"/>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-red-700 mb-2">Terjadi Kesalahan</h2>
            <ul class="text-gray-700 text-sm space-y-1 text-left list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
