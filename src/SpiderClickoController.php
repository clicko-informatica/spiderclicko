<?php

namespace Clicko\SpiderClicko;

use App\Http\Controllers\Controller;
use Request;

class SpiderClickoController extends Controller
{
    public function index()
    {
        return redirect()->route('task.create');
    }

    public function create()
    {
        $tasks = ClickoLog::all();
        $submit = 'Add';
        return view('wisdmlabs.todolist.list', compact('tasks', 'submit'));
    }

    public function store()
    {
        $input = Request::all();
        ClickoLog::create($input);
        return redirect()->route('task.create');
    }

    public function edit($id)
    {
        $tasks = ClickoLog::all();
        $task = $tasks->find($id);
        $submit = 'Update';
        return view('wisdmlabs.todolist.list', compact('tasks', 'task', 'submit'));
    }

    public function update($id)
    {
        $input = Request::all();
        $task = ClickoLog::findOrFail($id);
        $task->update($input);
        return redirect()->route('task.create');
    }

    public function destroy($id)
    {
        $task = ClickoLog::findOrFail($id);
        $task->delete();
        return redirect()->route('task.create');
    }
}
