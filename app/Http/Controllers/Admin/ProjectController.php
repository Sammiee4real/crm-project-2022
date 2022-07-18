<?php

namespace App\Http\Controllers\Admin;


use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Service\ModelsService;
use App\Http\Controllers\Controller;
use App\Service\TaskCompletionService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

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
            'image_path' => $project->getFirstMediaUrl('media','thumb'),    
            'percentage_completion' => (new TaskCompletionService())->completedTasksPerProjectPercentage($project->id).'%',
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
        $clients = Client::all();
        $users = User::all();
        return Inertia::render('Projects/Create',compact('clients','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        // dd($request->hasFile('project_image'));
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'user_id' => User::where('first_name',explode('-',$request->user_id)[0])->where('last_name',explode('-',$request->user_id)[1])->first()->id, //not the best approach
            'client_id' => (new ModelsService())->getIDFromTitle('contact_email',$request->client_id,Client::class) //maybe not the best approach           
        ];

        $project = Project::create($data);
        
        //spatie media library
        $project->addMediaFromRequest('project_image')->toMediaCollection('media','project_files');
     
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
        $clients = Client::all();
        $current_client = $project->client;
        $users = User::all();
        $current_user = $project->user;
        return Inertia::render('Projects/Edit',compact('project','current_client','clients','users','current_user'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response   UpdateProjectRequest
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        dd($request->hasFile('project_image'));

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            // 'user_id' => User::where('first_name',explode('-',$request->user_id)[0])->where('last_name',explode('-',$request->user_id)[1])->first()->id, //not the best approach
            // 'client_id' => (new ModelsService())->getIDFromTitle('contact_email',$request->client_id,Client::class) //maybe not the best approach           
        ];
        Project::where('id',$project->id)->update($data);

        //delete associated files first
        // $project->delete();

        //spatie media library
        $project->addMediaFromRequest('project_image')->toMediaCollection('media','project_files');
        // $project->addMediaFromRequest('project_image')->toMediaCollection('media','project_files');

        return redirect()->route('projects.index')->with('message','Project with title: '.$request->title.' was successfully updated');
        
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
