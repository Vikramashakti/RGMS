<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <i class="fas fa-tachometer-alt mr-2"></i>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <h3 class="text-2xl font-semibold" style="font-family: 'Sixtyfour', sans-serif;">
                        {{ __("Welcome, ") }}{{ Auth::user()->name }}
                    </h3>

                    <!-- Section for counts arranged left to right -->
                    <div class="mt-6 flex justify-between space-x-6">
                        <!-- Academicians count -->
                        <div class="flex-1 p-4 bg-black text-white rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Total Academicians</h4>
                            <p class="text-3xl font-bold">{{ $academiciansCount }}</p>
                        </div>

                        <!-- Research Grants count -->
                        <div class="flex-1 p-4 bg-black text-white rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Total Research Grants</h4>
                            <p class="text-3xl font-bold">{{ $researchGrantsCount }}</p>
                        </div>

                        <!-- Project Milestones count -->
                        <div class="flex-1 p-4 bg-black text-white rounded-lg shadow-md">
                            <h4 class="text-lg font-semibold">Total Project Milestones</h4>
                            <p class="text-3xl font-bold">{{ $projectMilestonesCount }}</p>
                        </div>
                    </div>

                    <!-- Buttons with icons -->
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <a href="{{ route('academicians.index') }}" class="block text-center py-4 px-6 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md transition-all duration-200">
                            <i class="fas fa-users"></i>
                            <span class="ml-2">Manage Academicians</span>
                        </a>
                        <a href="{{ route('researchGrants.index') }}" class="block text-center py-4 px-6 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition-all duration-200">
                            <i class="fas fa-graduation-cap"></i>
                            <span class="ml-2">Manage Research Grants</span>
                        </a>
                        <a href="{{ route('projectMilestones.index') }}" class="block text-center py-4 px-6 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md transition-all duration-200">
                            <i class="fas fa-tasks"></i>
                            <span class="ml-2">Manage Project Milestones</span>
                        </a>
                        <a href="{{ route('projectMembers.index') }}" class="block text-center py-4 px-6 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg shadow-md transition-all duration-200">
                            <i class="fas fa-users-cog"></i>
                            <span class="ml-2">Manage Project Members</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
