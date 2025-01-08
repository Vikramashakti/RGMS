<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-900 leading-tight">
            <i class="fas fa-users mr-2"></i>
            {{ __('View Academician') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-red-700 dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <div class="space-y-6">
                        <div class="bg-red-100 dark:bg-red-600 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-red-900 dark:text-red-100">Name:</h3>
                            <p class="text-black dark:text-black">{{ $academician->name }}</p>
                        </div>

                        <div class="bg-red-100 dark:bg-red-600 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-red-900 dark:text-red-100">Staff Number:</h3>
                            <p class="text-black dark:text-black">{{ $academician->staff_number }}</p>
                        </div>

                        <div class="bg-red-100 dark:bg-red-600 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-red-900 dark:text-red-100">Email:</h3>
                            <p class="text-black dark:text-black">{{ $academician->email }}</p>
                        </div>

                        <div class="bg-red-100 dark:bg-red-600 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-red-900 dark:text-red-100">College:</h3>
                            <p class="text-black dark:text-black">{{ $academician->college }}</p>
                        </div>

                        <div class="bg-red-100 dark:bg-red-600 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-red-900 dark:text-red-100">Department:</h3>
                            <p class="text-black dark:text-black">{{ $academician->department }}</p>
                        </div>

                        <div class="bg-red-100 dark:bg-red-600 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-red-900 dark:text-red-100">Position:</h3>
                            <p class="text-black dark:text-black">{{ $academician->position }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('academicians.index') }}" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-md">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
