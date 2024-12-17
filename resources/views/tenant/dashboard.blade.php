<h3>{{ auth()->user()->name }}</h3>
<h3>{{ auth()->user()->email }}</h3>

<form action="{{ route('tasks.index') }}" method="GET" style="display: inline;">
    <button type="submit" 
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Tasks
    </button>
</form>


<form method="POST" action="{{ route('tenant.logout') }}" style="display: inline; margin-left: 10px;">
    @csrf
    <button type="submit" 
            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
        Logout
    </button>
</form>
