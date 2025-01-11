@php
    $classes = "border-solid border-l-2 shadow";

    $statuses = config('flash-message.statuses');

    if (isset($statuses[$status]['color']) && !empty($statuses[$status]['color'])) {
        $backgroundColor = $statuses[$status]['color'];
    } else {
        $backgroundColor .= "#3b82f6";
    }
@endphp

<div {{ $attributes->merge(['class' => 'border-solid border-l-2 shadow']) }} style="border-color: {{ $backgroundColor }}">
    <div class="p-4 bg-white">
        <p class="font-semibold">{{ $title }}</p>
        <p class="text-sm">{{ $description }}</p>
    </div>
</div>
