@props(['categories' => [], 'selected' => 'all'])

<div class="mb-4 text-lg">
    <form method="get" id="category-filter-form">
        @foreach (request()->except('category') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <label for="category" class="text-lg text-white">Filter by Genre:</label>
        <select name="category" 
                id="category" 
                class="input p-1 w-fit inline text-center" 
                onchange="document.getElementById('category-filter-form').submit()"
        >
            <option value="all" {{ $selected === 'all' ? 'selected' : '' }}>All Posts</option>
            @foreach ($categories as $value => $label)
                <option value="{{ $value }}" {{ $selected === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </form>
</div>