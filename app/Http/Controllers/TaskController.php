<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    private TaskRepositoryInterface $taskRepositoryInterface;
    public function __construct(TaskRepositoryInterface $taskRepositoryInterface){
        $this->taskRepositoryInterface = $taskRepositoryInterface;
    }
    //Dohvatanje svih zadataka
    public function index(){
        $data = $this->taskRepositoryInterface->index();
        return ApiResponse::sendResponse(TaskResource::collection($data),'',200);
    }
    public function store(StoreTaskRequest $request){
        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];
        DB::beginTransaction();
        try{
            $task = $this->taskRepositoryInterface->store($data);
            DB::commit();
            return ApiResponse::sendResponse(new TaskResource($task),'Task successfully created',201);
        }catch(Exception $ex){
            return ApiResponse::rollback($ex);
        }
    }
    public function show($id){
        $task = $this->taskRepositoryInterface->getById($id);
        if(!$task)
            return ApiResponse::sendResponse('Invalid task id', 'Get Failed', 400);
        return ApiResponse::sendResponse(new TaskResource($task),'',200);
    }
    public function update(UpdateTaskRequest $request, $id){
        $updateData = [
            'title' => $request->title,
            'description' => $request->description
        ];
        DB::beginTransaction();
        try{
            $task = $this->taskRepositoryInterface->update($updateData, $id);
            if(!$task)
                return ApiResponse::sendResponse('Invalid task id', 'Update failed', 400);
            DB::commit();
            return ApiResponse::sendResponse('Task updated','Update successful',200);
        }catch(Exception $ex){
            return ApiResponse::rollback($ex);
        }
    }
    public function markAsComplete($id){
        DB::beginTransaction();
        try{
            $task = $this->taskRepositoryInterface->markAsComplete($id);
            if(!$task)
                return ApiResponse::sendResponse('Invalid task id', 'Update failed', 400);
            DB::commit();
            return ApiResponse::sendResponse('Marked as complete','Update successful',200);
        }catch(Exception $ex){
            return ApiResponse::rollback($ex);
        }
    }
    public function delete($id){
        DB::beginTransaction();
        try{
            $task = $this->taskRepositoryInterface->delete($id);
            if(!$task)
                return ApiResponse::sendResponse('Invalid task id', 'Delete failed', 400);
            DB::commit();
            return ApiResponse::sendResponse('Task deleted', 'Delete successful', 204);
        }catch(Exception $ex){
            return ApiResponse::rollback($ex);
        }
    }
}
