
<h1 class="text-3xl font-bold mb-4">Tasks</h1>

@if (session('success'))
    <div class="alert alert-success mb-4 p-4 bg-green-200 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<ul class="space-y-4">
    @foreach($tasks as $task)
        <li class="flex justify-between items-center bg-white p-4 shadow rounded">
            <div class="flex items-center space-x-6">
                <span class="w-48">{{ $task->title }}</span>
                
                <form action="{{ route('tasks.edit', $task->id) }}" method="GET" style="display:inline;">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Edit
                    </button>
                </form>                
               
                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </li>
    @endforeach
</ul>

<div class="mt-6">
    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create New Task</a>
</div>

