<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Test Modal</title>
    @vite('resources/css/app.css') <!-- Your Tailwind CSS -->
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

<div class="p-8" x-data="{ showModal: false }">
    <button @click="showModal = true" 
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Open Modal
    </button>

    <!-- Modal backdrop -->
    <div x-show="showModal" 
         x-cloak
         class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50"
         @click.self="showModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
    >
        <!-- Modal box -->
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-lg"
             @click.stop>
            <h2 class="text-xl font-semibold mb-4">Create New Post</h2>
            <form>
                <label class="block mb-1" for="title">Title</label>
                <input type="text" id="title" class="w-full border rounded px-3 py-2 mb-4 dark:bg-gray-700" />

                <label class="block mb-1" for="content">Content</label>
                <textarea id="content" rows="4" class="w-full border rounded px-3 py-2 dark:bg-gray-700"></textarea>

                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" @click="showModal = false"
                            class="px-4 py-2 border rounded hover:bg-gray-100 dark:hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
