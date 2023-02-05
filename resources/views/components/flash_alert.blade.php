@if ($message)
    <div class="absolute top-[50px] left-1/2 transform -translate-x-1/2 -translate-y-1/2" x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 7000)" x-show="show">
        <div class="p-4 mb-4 text-sm {{ isset($alert) && $alert === 'error' ? 'text-red-700 bg-red-100' : 'text-green-700 bg-green-100' }} rounded-lg"
            role="alert">
            {{ $message }}
        </div>
    </div>
@endif
