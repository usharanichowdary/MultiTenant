<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('tenant_id', tenant('id'))->get(); 
        return view('tasks.index', compact('tasks'));
    }

    
    public function create()
{
    return view('tasks.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',  
        'description' => 'required|string',   
    ]);

    Task::create([
        'title' => $request->name,            
        'description' => $request->description, 
        'tenant_id' => auth()->user()->tenant_id, 
        'completed' => false,  
    ]);

    return redirect()->route('tasks.index');
}

    public function edit($id)
    {
        $task = Task::where('tenant_id', tenant('id'))->findOrFail($id);
        return view('tasks.edit', compact('task'));
    }
    
    public function update(Request $request, Task $task)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'completed' => 'nullable|boolean', 
    ]);

    $task->update([
        'title' => $request->name, 
        'description' => $request->description,
        'completed' => $request->has('completed'), 
        'tenant_id' => auth()->user()->tenant_id, 
    ]);

    return redirect()->route('tasks.index');
}

   
    public function destroy($id)
{
    $task = Task::where('tenant_id', tenant('id'))->findOrFail($id);
    $task->delete();

    return redirect()->route('tasks.index');
}

}
