@props(['categories' => [], 'selected' => 'all'])

<div class="mb-4 text-lg">
    <form method="get" id="category-filter-form">
        @foreach (request()->except('category') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <label for="category" class="text-lg">Filter by Genre:</label>
        <select name="category" 
                id="category" 
                class="p-1 rounded-md ring-1 ring-slate-600 focus:ring-slate-900 focus:ring-2 outline-0 border-0 mt-1" 
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