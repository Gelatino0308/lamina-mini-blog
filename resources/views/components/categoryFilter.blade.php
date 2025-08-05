@props(['categories' => []])

<div class="mb-4 text-lg">
    <label for="category" class="text-lg">Filter by Genre:</label>
    <select name="category" id="category" 
            class="p-1 rounded-md ring-1 ring-slate-600 focus:ring-slate-900 focus:ring-2 outline-0 border-0 mt-1" 
            x-model="selectedCategory">
        <option value="all" selected>All</option>
        @foreach ($categories as $value => $label)
            <option value="{{ $value }}" {{ old('category' == $value ? 'selected' : '' ) }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>