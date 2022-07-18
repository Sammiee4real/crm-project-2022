<?php 
namespace App\Service;
use App\Models\Project;
use App\Models\Task;

class TaskCompletionService
{
//   public $project_id;
  
  public function completedTasksPerProjectPercentage($project_id)
  {
        $project = Project::with('tasks')->find($project_id);     
        $tasks_completed = 0;
        // $total_tasks = $project->tasks_count;
        $total_tasks = count($project->tasks);

        foreach($project->tasks as $task)
        {
            if($task->status == 'completed'){
                $tasks_completed++;
            }
        }

        if($tasks_completed == 0){
            return 0;
        }else{
            return floor( ($tasks_completed / $total_tasks) * 100);
        }

   }
}