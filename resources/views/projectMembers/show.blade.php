<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project Member Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-6">
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Research Grant:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMember->researchGrant->project_title }}</p>
                        </div>

                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Academician:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMember->academician->name }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('projectMembers.index') }}" class="btn btn-secondary mt-4 px-6 py-2 bg-gray-300 hover:bg-gray-400 text-white rounded-lg shadow-md">
                            Back to Members List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
