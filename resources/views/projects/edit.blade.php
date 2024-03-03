<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit project
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8  bg-white shadow-md rounded-md">
            
            @if ($errors->any())
            <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Danger</span>
                <div>
                    <span class="font-medium">Ensure that these requirements are met:</span>
                    <ul class="mt-1.5 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            
            <form method="POST" action="{{ route('projects.update', $project->id) }}" class="p-4" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mt-2">
                    <label for="skill_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a skill</label>
                    <select id="skill_id" name="skill_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($skills as $skill)
                            <option value="{{ $skill->id }}" @selected(old('skill_id', $project->skill_id) == $skill->id)>{{ $skill->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                
                <!-- Name -->
                <div class="mt-2">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $project->name)"/>
                </div>
                
                <!-- Project URL -->
                <div class="mt-2">
                    <x-input-label for="project_url" :value="__('URL')" />
                    <x-text-input id="project_url" class="block mt-1 w-full" type="text" name="project_url" :value="old('project_url', $project->project_url)"/>
                </div>
                
                <!-- Image -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    
                    <x-text-input id="image" class="block mt-1 w-full"
                    type="file"
                    name="image"/>
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    
                    <x-primary-button class="ms-3">
                        Update
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
