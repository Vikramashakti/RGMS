<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Project Milestone Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-800 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="space-y-8"> <!-- Increased gap between sections -->
                        <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Milestone Name:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMilestone->milestone_name }}</p>
                        </div>

                        <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Research Grant:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMilestone->researchGrant->project_title }}</p>
                        </div>

                        <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Target Completion Date:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMilestone->target_completion_date }}</p>
                        </div>

                        <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Deliverable:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMilestone->deliverable }}</p>
                        </div>

                        <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Status:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMilestone->status }}</p>
                        </div>

                        <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Remarks:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMilestone->remark }}</p>
                        </div>

                        <div class="bg-green-100 dark:bg-green-700 p-4 rounded-lg shadow-sm">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Last Updated:</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ $projectMilestone->date_updated ? $projectMilestone->date_updated->format('Y-m-d H:i:s') : 'Not Updated' }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('projectMilestones.index') }}" class="btn btn-secondary mt-4 px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md">
                            Back to Milestones
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
