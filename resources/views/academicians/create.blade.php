<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red leading-tight">
            {{ __('Add Academician') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-red-700 dark:bg-red-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <form action="{{ route('academicians.store') }}" method="POST">
                        @csrf
                        <!-- User Dropdown -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-white">Name</label>
                            <select name="users_id" id="name" class="form-select rounded-md shadow-sm mt-1 block w-full text-black" required>
                                <option value="" disabled selected>Select a name</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" data-email="{{ $user->email }}" data-name="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Name Field (Dynamically updated based on user selection) -->
                        <div class="mb-4">
                            <label for="selected_name" class="block font-medium text-sm text-white">Selected Name</label>
                            <input type="text" name="name" id="selected_name" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required readonly>
                        </div>

                        <!-- Email Field (Dynamically updated) -->
                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-white">Email</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required readonly>
                        </div>

                        <!-- Staff Number Field -->
                        <div class="mb-4">
                            <label for="staff_number" class="block font-medium text-sm text-white">Staff Number</label>
                            <input type="text" name="staff_number" id="staff_number" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        
                        <!-- College Field -->
                        <div class="mb-4">
                            <label for="college" class="block font-medium text-sm text-white">College</label>
                            <input type="text" name="college" id="college" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        
                        <!-- Department Field -->
                        <div class="mb-4">
                            <label for="department" class="block font-medium text-sm text-white">Department</label>
                            <input type="text" name="department" id="department" class="form-input rounded-md shadow-sm mt-1 block w-full text-black" required>
                        </div>
                        
                        <!-- Position Dropdown -->
                        <div class="mb-4">
                            <label for="position" class="block font-medium text-sm text-white">Position</label>
                            <select name="position" id="position" class="form-select rounded-md shadow-sm mt-1 block w-full text-black" required>
                                <option value="Professor">Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Senior Lecturer">Senior Lecturer</option>
                                <option value="Lecturer">Lecturer</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to dynamically update name and email fields based on selected user -->
    <script>
        document.getElementById('name').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const name = selectedOption.getAttribute('data-name');
            const email = selectedOption.getAttribute('data-email');

            // Update name and email fields dynamically
            document.getElementById('selected_name').value = name;
            document.getElementById('email').value = email;
        });
    </script>
</x-app-layout>
