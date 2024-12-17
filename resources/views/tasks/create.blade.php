
    <h1 class="text-3xl font-bold mb-6">Create New Task</h1>

    <div class="bg-gray-100 p-6 rounded shadow-md">
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="flex flex-col">
                <label for="name" class="font-medium text-gray-700 mb-2">Task Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Task Name" 
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       required>
            </div>
            
            <div class="flex flex-col">
                <label for="description" class="font-medium text-gray-700 mb-2">Task Description</label>
                <textarea id="description" name="description" placeholder="Enter Task Description" 
                          class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" 
                          rows="4" required></textarea>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Create Task
                </button>
            </div>
        </form>
    </div>

