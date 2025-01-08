<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-800 dark:text-yellow-200 leading-tight">
            <i class="fas fa-users-cog mr-2"></i>
            {{ __('Project Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Yellow box with soft border and shadow -->
            <div class="bg-yellow-500 dark:bg-yellow-800 border border-yellow-300 dark:border-yellow-700 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-yellow-700 dark:text-yellow-100">
                    <a href="{{ route('projectMembers.create') }}" class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg mb-4 inline-block transition-all duration-200">Add/Update Project Member</a>

                    @forelse($researchGrants as $grant)
                        <div class="mb-6 border-b border-yellow-300 dark:border-yellow-700 pb-4">
                            <!-- Link to view the specific research grant -->
                            <h3 class="text-lg font-medium text-yellow-900 dark:text-yellow-100 mb-2">
                                <a href="{{ route('researchGrants.show', $grant->id) }}" class="hover:text-yellow-500">
                                    {{ $grant->project_title }}
                                </a>
                            </h3>

                            <!-- Display the Project Leader -->
                            <div class="mb-4">
                                <strong>Project Leader:</strong>
                                <span class="text-yellow-900 dark:text-yellow-100">{{ $grant->projectLeader->name }}</span>
                            </div>

                            <!-- Check if there are project members excluding the leader -->
                            @if($grant->projectMembers->where('id', '!=', $grant->projectLeader->id)->count() > 0)
                                <table class="min-w-full table-auto bg-yellow-50 dark:bg-yellow-900 rounded-lg shadow-md overflow-hidden">
                                    <thead>
                                        <tr class="bg-yellow-200 dark:bg-yellow-700 text-left text-sm text-yellow-700 dark:text-yellow-300">
                                            <th class="px-6 py-3">Name</th>
                                            <th class="px-6 py-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grant->projectMembers as $member)
                                            @if ($member->id != $grant->projectLeader->id) <!-- Exclude project leader -->
                                                <tr class="bg-yellow-50 dark:bg-yellow-900 hover:bg-yellow-100 dark:hover:bg-yellow-700">
                                                    <td class="px-6 py-4 text-sm text-yellow-800 dark:text-yellow-200">{{ $member->name }}</td>
                                                    <td class="px-6 py-4 text-sm text-yellow-800 dark:text-yellow-200">
                                                        <div class="flex space-x-4">
                                                            <a href="{{ route('academicians.edit', $member->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded transition-all duration-200">Edit</a>
                                                            <form action="{{ route('projectMembers.destroy', $member->pivot->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded transition-all duration-200">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-sm text-yellow-700 dark:text-yellow-400">No project members added yet.</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-yellow-700 dark:text-yellow-400">No research grants available.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
