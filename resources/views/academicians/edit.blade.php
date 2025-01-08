<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-900 leading-tight">
            {{ __('Edit Academician') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-red-700 dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <form action="{{ route('academicians.update', $academician->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-white">Name</label>
                            <input type="text" name="name" id="name" value="{{ $academician->name }}" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="staff_number" class="block font-medium text-sm text-white">Staff Number</label>
                            <input type="text" name="staff_number" id="staff_number" value="{{ $academician->staff_number }}" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-white">Email</label>
                            <input type="email" name="email" id="email" value="{{ $academician->email }}" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="college" class="block font-medium text-sm text-white">College</label>
                            <input type="text" name="college" id="college" value="{{ $academician->college }}" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="department" class="block font-medium text-sm text-white">Department</label>
                            <input type="text" name="department" id="department" value="{{ $academician->department }}" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="position" class="block font-medium text-sm text-white">Position</label>
                            <select name="position" id="position" class="form-select rounded-md shadow-sm mt-1 block w-full text-black" required>
                                <option value="Professor" {{ $academician->position == 'Professor' ? 'selected' : '' }}>Professor</option>
                                <option value="Associate Professor" {{ $academician->position == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                <option value="Senior Lecturer" {{ $academician->position == 'Senior Lecturer' ? 'selected' : '' }}>Senior Lecturer</option>
                                <option value="Lecturer" {{ $academician->position == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-md transition-all duration-200">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
