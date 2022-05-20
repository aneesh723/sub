@props(['errors'])

@if ($errors->any())
    <div class="mt-2 mb-0" {{ $attributes }}>
        <div class="font-medium text-danger mt-2 ml-3">Whoops! Something went wrong...</div>

        <div class="mt-3 pb-0 mb-0 text-sm ml-3 text-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif
