@props([
    'label' => 'Sample Text',
    'total' => 218,
    'icon' => 'fi fi-rr-employee-man',
    'sub_label' => 'sample sub label',
    'url' => null,
])

<div class="border rounded-lg shadow-md p-4 bg-white">
    <!-- Card Header -->

    @if ($url)
        <a href="{{ $url }}" class="text-lg font-semibold text-gray-800 hover:link">
            {{ $label }}
        </a>
    @else
        <h3 class="text-lg font-semibold text-gray-800">
            {{ $label }}
        </h3>
    @endif

    <!-- Employee Count -->
    <div class="mt-2 text-4xl font-bold text-gray-900">
        {{ $total }}
    </div>

    <!-- Growth Rate -->
    <div class="flex items-center mt-2">
        <!-- Flaticon Icon -->
        <i class="{{ $icon }}"></i>

        <span class="text-sm font-medium text-green-600 ml-1">
            {{ $total }}
        </span>
        <span class="text-sm text-gray-500 ml-2">
            {{ $sub_label }}
        </span>
    </div>
</div>
