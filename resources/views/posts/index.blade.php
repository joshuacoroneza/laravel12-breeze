<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="py-12" x-data="{
                            showModal: false,
                            editModal: false,
                            deleteModal: false,
                            editPost: null,
                            deletePostId: null
                        }">
                        <!-- Header -->
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-2xl font-bold">My Posts</h1>
                            <button @click="showModal = true"
                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                + New Post
                            </button>
                        </div>


                        <div class="mb-4">
                            @if (session('success'))
                                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                                    class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="bg-red-100 text-red-800 px-4 py-2 rounded">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

                        


                        <!-- Table -->
                        <div class="w-full overflow-x-auto rounded shadow">
                            <table class="w-full text-sm text-left text-gray-800 dark:text-gray-200 border-collapse">
                                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 border-b dark:border-gray-600">#</th>
                                        <th scope="col" class="px-6 py-3 border-b dark:border-gray-600">Title</th>
                                        <th scope="col" class="px-6 py-3 border-b dark:border-gray-600">Content</th>
                                        <th scope="col" class="px-6 py-3 border-b dark:border-gray-600">Author</th>
                                        <th scope="col" class="px-6 py-3 border-b dark:border-gray-600">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($posts as $index => $post)
                                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                            <td class="px-6 py-4 border-b dark:border-gray-700">{{ $posts->firstItem() + $index }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-700 font-medium">{{ $post->title }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-700">{{ Str::limit($post->content, 100) }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-700">{{ $post->user->name }}</td>
                                            <td class="px-6 py-4 border-b dark:border-gray-700 flex gap-2">
                                                <button @click="editPost = {{ $post }}, editModal = true"
                                                        class="text-sm px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                    Edit
                                                </button>
                                                <button @click="deletePostId = {{ $post->id }}, deleteModal = true"
                                                        class="text-sm px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                No posts found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>


                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>

                        
                        

                        <!-- Modal -->
                        <div x-show="showModal" 
                            x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 backdrop-blur-sm px-4"
                            @click.self="showModal = false"
                            x-transition>
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-sm"
                                @click.stop>
                                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Create New Post</h2>

                                <form action="{{ route('posts.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="title" class="block mb-1 text-gray-700 dark:text-gray-300">Title</label>
                                        <input type="text" id="title" name="title" required
                                            class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300 focus:outline-none" />
                                    </div>
                                    <div class="mb-4">
                                        <label for="content" class="block mb-1 text-gray-700 dark:text-gray-300">Content</label>
                                        <textarea id="content" name="content" rows="4" required
                                                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white focus:ring focus:ring-blue-300 focus:outline-none"></textarea>
                                    </div>

                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="showModal = false"
                                                class="px-4 py-2 border rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div x-show="editModal" x-cloak @click.self="editModal = false"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 backdrop-blur-sm px-4"
                            x-transition>
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-sm" @click.stop>
                                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Edit Post</h2>

                                <form :action="`/posts/${editPost.id}`" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block mb-1 text-gray-700 dark:text-gray-300">Title</label>
                                        <input type="text" name="title" x-model="editPost.title" required
                                            class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="block mb-1 text-gray-700 dark:text-gray-300">Content</label>
                                        <textarea name="content" rows="4" x-model="editPost.content" required
                                                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-700 dark:text-white"></textarea>
                                    </div>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="editModal = false"
                                                class="px-4 py-2 border rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div x-show="deleteModal" x-cloak @click.self="deleteModal = false"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-10 backdrop-blur-sm px-4"
                            x-transition>
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg w-full max-w-sm" @click.stop>
                                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Confirm Delete</h2>
                                <p class="text-gray-700 dark:text-gray-300 mb-4">Are you sure you want to delete this post?</p>
                                <form :action="`/posts/${deletePostId}`" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="deleteModal = false"
                                                class="px-4 py-2 border rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                            Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
