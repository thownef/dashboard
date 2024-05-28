@props(['field'])

@php
    $iconUp = 'sorting_asc';
    $iconDown = 'sorting_desc';
    $icon = '';
    $newSortField = $field;
    $sortLink = request()->fullUrlWithQuery(['sort' => '']);

    if ($field === request('sort')) {
        if (request('sort')[0] === '-') {
            $newSortField = ltrim(request('sort'), '-');
            $icon = $iconDown;
        } else {
            $newSortField = '-' . request('sort');
            $icon = $iconUp;
        }
    }

    $sortLink = request()->fullUrlWithQuery(['sort' => $newSortField]);

    if ('-' .$field === request('sort')) {
        $icon = $iconDown;
        $sortLink = request()->fullUrlWithoutQuery('sort');
    }
@endphp

<a class="sorting {{ $icon }}" href="{{ $sortLink }}">
    {{ $slot }}
</a>