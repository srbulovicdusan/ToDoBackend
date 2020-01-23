<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTodoRequest;
use App\Http\Requests\EditTodoRequest;
use App\Services\TodoService;
use App\Models\Todos;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(TodoService $todoService)
    {
        $this->service = $todoService;
    }
    
    public function getAllUserTodos(Request $request){
        $user = auth()->user();
        return $this->service->getAll($user);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTodoRequest $request)
    {
        $user = auth()->user();
        $todo = $request->validated();
        return $this->service->create($todo, $user);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function edit(EditTodoRequest $request)
    {
        $data = request(['id', 'title', 'description', 'priority', 'completed']);
        $updatedTodo = $this->service->update($data);
        if ($updatedTodo){
            return $updatedTodo;
        }else{
            return abort("Not found.", 404);
        }
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {  
        $id = $request->id;
        $id = $this->service->delete($id);
        if ($id == null){
            abort("Todo not found", 404);
        }
        return response()->json(['message'=>'delete success'], 200);
    }
}
