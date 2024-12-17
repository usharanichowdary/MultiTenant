<h1>Edit Task</h1>

<form method="POST" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT') 

    <div>
        <label for="name">Title</label>
        <input type="text" id="name" name="name" value="{{ old('name', $task->title) }}" required>
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" required>{{ old('description', $task->description) }}</textarea>
    </div>

    <div>
        <label for="completed">Completed</label>
        <!-- Hidden field to ensure a default value -->
        <input type="hidden" name="completed" value="0">
        <input type="checkbox" id="completed" name="completed" value="1" {{ $task->completed ? 'checked' : '' }}>
    </div>

    <button type="submit">Update Task</button>
</form>

<a href="{{ route('tasks.index') }}">Back to Task List</a>
