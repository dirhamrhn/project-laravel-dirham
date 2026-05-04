<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('welcome', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        Task::create($request->all());

        return redirect('/');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect('/');
    }
}