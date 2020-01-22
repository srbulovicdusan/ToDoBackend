<?php

namespace App\Http\Controllers;

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
        $todos = $this->service->getAll();
        return response()->json($todos);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = request(['title', 'description', 'priority', 'completed']);
        $createdTodo = $this->service->create($todo);
        return response()->json($createdTodo, 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = request(['id', 'title', 'description', 'priority', 'completed']);
        $todo = $this->service->update($data);
        return response()->json($todo, 200);
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
    }
}
