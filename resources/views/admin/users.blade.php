<x-admin-layout title="Users">
    {{-- Page Header --}}
    <h2 class="text-2xl mb-6 font-bold text-orange-200">Total: {{ $users->total() }} user/s</h2>

    {{-- Users Table --}}
    <div class="bg-orange-100 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-orange-200">
                    <tr class="text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Username</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Registration Date</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-orange-100 divide-y divide-gray-300">
                    @forelse($users as $user)
                        <tr class="hover:bg-orange-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->username }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div data-user-role-dropdown data-user-id="{{ $user->id }}" data-current-role="{{ $user->role }}"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($user->id !== auth()->id())
                                    <div data-admin-modal data-modal-type="delete-user" data-item-id="{{ $user->id }}"></div>
                                @else
                                    <span class="text-sm">Current User</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $users->links() }}
    </div>
</x-admin-layout>