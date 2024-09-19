<?php

namespace App\Repositories;
use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function index(){
        return Task::all()->sortByDesc('created_at');
    }
    public function getById($id){
        return Task::findOrFail($id);
    }
    public function store(array $data){
        return Task::create([
            'title' => $data['title'],
            'description' => $data['description']
        ]);
    }
    public function update(array $data, $id){
        return Task::where('id','=',$id)->update([
            'title' => $data['title'],
            'description' => $data['description']
        ]);
    }
    public function markAsComplete($id){
        $task = Task::findOrFail($id);
        $completed = !$task->completed;
        return Task::where('id','=',$id)->update([
            'completed'=>$completed
        ]);
    }
    public function delete($id){
        return Task::destroy($id);
    }
}
