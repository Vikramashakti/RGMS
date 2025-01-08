<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-green-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-tasks mr-2"></i>
            {{ __('Edit Project Milestone') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Updated background color for the white box -->
            <div class="bg-green-700 dark:bg-green-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('projectMilestones.update', $projectMilestone->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="research_grant_id" class="block text-sm font-medium text-white dark:text-white">Research Grant</label>
                            <select name="research_grant_id" id="research_grant_id" class="mt-1 block w-full border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @forelse ($researchGrants as $grant)
                                    <option value="{{ $grant->id }}" @selected($grant->id == $projectMilestone->research_grant_id)>{{ $grant->project_title }}</option>
                                @empty
                                    <option value="" disabled>No Research Grants available</option>
                                @endforelse
                            </select>
                            @error('research_grant_id')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="milestone_name" class="block text-sm font-medium text-white dark:text-white">Milestone Name</label>
                            <input type="text" name="milestone_name" id="milestone_name" value="{{ old('milestone_name', $projectMilestone->milestone_name) }}" class="mt-1 block w-full border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                            @error('milestone_name')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="target_completion_date" class="block text-sm font-medium text-white dark:text-white">Target Completion Date</label>
                            <input type="date" name="target_completion_date" id="target_completion_date" value="{{ old('target_completion_date', $projectMilestone->target_completion_date) }}" class="mt-1 block w-full border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                            @error('target_completion_date')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="deliverable" class="block text-sm font-medium text-white dark:text-white">Deliverable</label>
                            <textarea name="deliverable" id="deliverable" rows="3" class="mt-1 block w-full border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>{{ old('deliverable', $projectMilestone->deliverable) }}</textarea>
                            @error('deliverable')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-white dark:text-white">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                <option value="Not Started" @selected($projectMilestone->status == 'Not Started')>Not Started</option>
                                <option value="In Progress" @selected($projectMilestone->status == 'In Progress')>In Progress</option>
                                <option value="Completed" @selected($projectMilestone->status == 'Completed')>Completed</option>
                            </select>
                            @error('status')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="remark" class="block text-sm font-medium text-white dark:text-white">Remarks (Optional)</label>
                            <textarea name="remark" id="remark" rows="3" class="mt-1 block w-full border-green-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('remark', $projectMilestone->remark) }}</textarea>
                        </div>

                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg shadow-md transition-all duration-200">Update Milestone</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
