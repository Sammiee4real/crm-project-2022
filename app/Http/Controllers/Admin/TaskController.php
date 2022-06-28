<?php

namespace App\Http\Controllers\Admin;

// use App\Services\ModelsService;
use modelsService;
use App\Models\Task;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::query()
        ->when(request()->input('search'), function($query,$searchParam){    
            $query->where('title','like',"%{$searchParam}%")
            ->orWhere('status','like',"%{$searchParam}%");
        })
        ->paginate(10)
        ->withQueryString()
        ->through(fn($task) =>[
        'id' => $task->id,
        'title' => $task->title,
        'description' => $task->description,
        'deadline' => $task->deadline,
        'status' => $task->status,
        'project' => Task::find($task->id)->project, 
         ]);

        return Inertia::render('Tasks/Index',[
            'tasks' => $tasks,
            // 'projects' => Project::all(),
            'total_tasks' => Task::count(),
            'filters' => request()->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tasks/Create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index')->with('message','Task with title: '.$request->title.' was successfully created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return Inertia::render('Tasks/Show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $projects = Project::all();
        $current_project = Task::find($task->id)->project;
        // dd($projects);
        return Inertia::render('Tasks/Edit',compact('task','projects','current_project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {   
        // dd(  (new modelsService())->getIDFromTitle('title',$request->project_id,'Project'));
        // dd(Project::where('title',$request->project_id)->first()->id);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'project_id' => Project::where('title',$request->project_id)->first()->id //not the best approach
        ];

        Task::where('id',$task->id)->update($data);
        return redirect()->route('tasks.index')->with('message','Task was successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('message','Task was successfully deleted');

    }
}
