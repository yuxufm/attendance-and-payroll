@if ($messages && $alert)

    @if ($alert === 'error')
        <div class="text-left p-4 mb-4 my-2 text-sm text-red-700 bg-red-100 rounded-lg capitalize" role="alert">
            <ul class="px-3 list-disc">
                @foreach ($messages as $success)
                    <li>{{ $success }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($alert === 'success')
        <div class="text-left p-4 mb-4 my-2 text-sm text-green-700 bg-green-100 rounded-lg capitalize" role="alert">
            <ul class="px-3 list-disc">
                @foreach ($messages as $success)
                    <li>{{ $success }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endif
