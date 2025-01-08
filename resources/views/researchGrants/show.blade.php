<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-blue-200 leading-tight">
            <i class="fas fa-graduation-cap mr-2"></i>
            {{ __('View Research Grant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-blue-700 dark:bg-blue-900 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-blue-900 dark:text-blue-100">
                    <div class="space-y-6">
                        <!-- Project Title -->
                        <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow-sm mb-6">
                            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Project Title:</h3>
                            <p class="text-blue-700 dark:text-blue-300">{{ $researchGrant->project_title }}</p>
                        </div>

                        <!-- Project Leader -->
                        <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow-sm mb-6">
                            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Project Leader:</h3>
                            <p class="text-blue-700 dark:text-blue-300">{{ $researchGrant->projectLeader->name }}</p>
                        </div>

                        <!-- Grant Amount -->
                        <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow-sm mb-6">
                            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Grant Amount:</h3>
                            <p class="text-blue-700 dark:text-blue-300">${{ number_format($researchGrant->grant_amount, 2) }}</p>
                        </div>

                        <!-- Grant Provider -->
                        <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow-sm mb-6">
                            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Grant Provider:</h3>
                            <p class="text-blue-700 dark:text-blue-300">{{ $researchGrant->grant_provider }}</p>
                        </div>

                        <!-- Start Date -->
                        <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow-sm mb-6">
                            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Start Date:</h3>
                            <p class="text-blue-700 dark:text-blue-300">{{ \Carbon\Carbon::parse($researchGrant->start_date)->format('M d, Y') }}</p>
                        </div>

                        <!-- Duration (Months) -->
                        <div class="bg-blue-100 dark:bg-blue-800 p-4 rounded-lg shadow-sm mb-6">
                            <h3 class="text-lg font-medium text-blue-900 dark:text-blue-100">Duration (Months):</h3>
                            <p class="text-blue-700 dark:text-blue-300">{{ $researchGrant->duration_months }}</p>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('researchGrants.index') }}" class="btn btn-secondary mt-4 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
