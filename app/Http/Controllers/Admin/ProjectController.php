<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $projects = Project::query()
            ->when(request()->input('search'), function($query,$searchParam){    
                $query->where('title','like',"%{$searchParam}%")
                ->orWhere('status','like',"%{$searchParam}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($project) =>[
            'id' => $project->id,
            'title' => $project->title,
            'description' => $project->description,
            'deadline' => $project->deadline,
            'status' => $project->status,
            'client' => Project::find($project->id)->client,
            'user' => Project::find($project->id)->user,  
            'tasks' => Task::where('project_id',$project->id)->get(),  
             ]);

            return Inertia::render('Projects/Index',[
                'projects' => $projects,
                'total_projects' => Project::count(),
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
        return Inertia::render('Projects/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        Project::create($request->validated());
        return redirect()->route('projects.index')->with('message','Project with title: '.$request->title.' was successfully created');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return Inertia::render('Projects/Show',compact('project'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit',compact('project'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        Project::where('id',$project->id)->update($request->validated());
        return redirect()->route('projects.index')->with('message','Project record was successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('message','Project was successfully deleted');

    }
}
