<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
            <i class="fas fa-graduation-cap mr-2"></i>
            {{ __('Research Grants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-700 dark:bg-blue-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-blue-900 dark:text-blue-100">
                    <a href="{{ route('researchGrants.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-lg">
                        Add Research Grant
                    </a>
                    <table class="min-w-full table-auto bg-blue-50 dark:bg-blue-800 rounded-lg shadow-md overflow-hidden">
                        <thead>
                            <tr class="bg-blue-200 dark:bg-blue-700 text-left text-sm text-blue-900 dark:text-blue-200">
                                <th class="px-6 py-3">Project Title</th>
                                <th class="px-6 py-3">Project Leader</th>
                                <th class="px-6 py-3">Grant Amount</th>
                                <th class="px-6 py-3">Start Date</th>
                                <th class="px-6 py-3">Duration (Months)</th>
                                <th class="px-6 py-3">Deadline</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($researchGrants as $grant)
                                <tr class="bg-blue-100 dark:bg-blue-900 border-b border-blue-200 dark:border-blue-700">
                                    <td class="px-6 py-4 text-sm">{{ $grant->project_title }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $grant->projectLeader->name }}</td>
                                    <td class="px-6 py-4 text-sm">${{ number_format($grant->grant_amount, 2) }}</td>
                                    <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($grant->start_date)->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $grant->duration_months }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="text-red-600 dark:text-red-400 font-semibold">
                                            {{ \Carbon\Carbon::parse($grant->start_date)->addMonths($grant->duration_months)->format('M d, Y') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm flex space-x-4">
                                        <a href="{{ route('researchGrants.show', $grant->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                            View
                                        </a>
                                        <a href="{{ route('researchGrants.edit', $grant->id) }}" class="px-3 py-1 bg-blue-400 text-white rounded-lg hover:bg-blue-500">
                                            Edit
                                        </a>
                                        <form action="{{ route('researchGrants.destroy', $grant->id) }}" method="POST" style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
