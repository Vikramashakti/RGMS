<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-800 dark:text-yellow-200 leading-tight">
            {{ __('Edit Project Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-yellow-100 dark:bg-yellow-800 border border-yellow-300 dark:border-yellow-700 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-yellow-900 dark:text-yellow-100">
                    <form action="{{ route('projectMembers.update', $projectMember->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Research Grant Dropdown -->
                        <div class="mb-4">
                            <label for="research_grant_id" class="block font-medium text-yellow-700 dark:text-yellow-200">Research Grant</label>
                            <select name="research_grant_id" id="research_grant_id" class="form-select rounded-md shadow-sm mt-1 block w-full text-black border border-yellow-300 dark:border-yellow-600" required>
                                @foreach($researchGrants as $grant)
                                    <option value="{{ $grant->id }}" {{ $projectMember->research_grant_id == $grant->id ? 'selected' : '' }}>{{ $grant->project_title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Academician Dropdown -->
                        <div class="mb-4">
                            <label for="academician_id" class="block font-medium text-yellow-700 dark:text-yellow-200">Academician</label>
                            <select name="academician_id" id="academician_id" class="form-select rounded-md shadow-sm mt-1 block w-full text-black border border-yellow-300 dark:border-yellow-600" required>
                                @foreach($academicians as $academician)
                                    <option value="{{ $academician->id }}" {{ $projectMember->academician_id == $academician->id ? 'selected' : '' }}>{{ $academician->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white py-2 px-4 rounded-lg transition-all duration-200">Update Member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
