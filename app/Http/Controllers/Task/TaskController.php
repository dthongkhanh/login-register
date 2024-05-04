<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\CreateTaskRequest;
use App\Http\Requests\Api\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Services\Task\CreateTaskService;
use App\Services\Task\DeleteTaskService;
use App\Services\Task\FilterTaskByStatusService;
use App\Services\Task\GetTaskService;
use App\Services\Task\SearchTaskService;
use App\Services\Task\SortTaskByTimeDueService;
use App\Services\Task\UpdateTaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = resolve(GetTaskService::class)->handle();
        if (!$tasks) {
            toastr()->error(__('messages.error_action', ['action' => 'display', 'attribute' => 'tasks',]));

            return redirect()->back();
        }

        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {
        $task = resolve(CreateTaskService::class)->setParams($request->validated())->handle();
        if (!$task) {
            toastr()->error(__('messages.error_action', ['action' => 'create', 'attribute' => 'task',]));

            return redirect()->back();
        }

        toastr()->success(__('messages.create_success', ['attribute' => 'task']));

        return redirect()->route('task.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('task.update', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = $id;
        $task = resolve(UpdateTaskService::class)->setParams($data)->handle();
        if (!$task) {
            toastr()->error(__('messages.error_action', ['action' => 'update', 'attribute' => 'task',]));

            return redirect()->back();
        }

        toastr()->success(__('messages.update_success', ['attribute' => 'task']));

        return redirect()->route('task.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task = resolve(DeleteTaskService::class)->setParams($task)->handle();
        if (!$task) {
            toastr()->error(__('messages.error_action', ['action' => 'display', 'attribute' => 'task',]));

            return redirect()->back();
        }

        toastr()->success(__('messages.delete_success', ['attribute' => 'task']));

        return redirect()->route('task.list');
    }

    /**
     * Filter the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $status = $request->input('status');
        $tasks = resolve(FilterTaskByStatusService::class)->setParams($status)->handle();
        if (!$tasks) {
            return redirect()->back();
        }

        return view('task.index', compact('tasks'));
    }

    /**
     * Sort the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        $direction = $request->input('direction');
        $tasks = resolve(SortTaskByTimeDueService::class)->setParams($direction)->handle();
        if (!$tasks) {
            return redirect()->back();
        }

        return view('task.index', compact('tasks'))->render();
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $text_search = $request->input('text_search');
        $tasks = resolve(SearchTaskService::class)->setParams($text_search)->handle();
        if (!$tasks) {
            return redirect()->back();
        }
        
        return view('task.index', compact('tasks'));
    }
}
