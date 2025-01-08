<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-900 leading-tight">
            <i class="fas fa-users mr-2"></i>
            {{ __('Academicians') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-red-700 dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <a href="{{ route('academicians.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 mb-6">Add Academician</a> <!-- Added margin-bottom -->
                    
                    <!-- Added padding to ensure space between button and table -->
                    <div class="mt-6">
                        <table class="min-w-full table-auto bg-red-100 dark:bg-red-600 rounded-lg shadow-md overflow-hidden">
                            <thead>
                                <tr class="bg-red-200 dark:bg-red-500 text-left text-sm text-gray-700 dark:text-gray-100">
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3">Staff Number</th>
                                    <th class="px-6 py-3">Email</th>
                                    <th class="px-6 py-3">College</th>
                                    <th class="px-6 py-3">Department</th>
                                    <th class="px-6 py-3">Position</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($academicians as $academician)
                                    <tr class="bg-white dark:bg-red-700">
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $academician->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $academician->staff_number }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $academician->email }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $academician->college }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $academician->department }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100">{{ $academician->position }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-100 flex space-x-8">
                                            <a href="{{ route('academicians.show', $academician->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded-lg transition-all duration-200">View</a>
                                            <a href="{{ route('academicians.edit', $academician->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-1 px-3 rounded-lg transition-all duration-200">Edit</a>
                                            <form action="{{ route('academicians.destroy', $academician->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded-lg transition-all duration-200" onclick="return confirm('Are you sure?')">Delete</button>
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
    </div>
</x-app-layout>
