<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    
    public function all(Request $request){
        $user = auth()->user();
        return response()->json($user->todos);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $validatedData = request(['title', 'description', 'priority', 'completed']);
        $todo = Todos::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'priority' => $validatedData['priority'],
            'completed' => $validatedData['completed'],
            'user_id' => $user->id
        ]);
        return response()->json($todo);
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
        $todo = Todos::find($data['id']);
        if ($todo != null){
            $todo->title = $data['title'];
            $todo->description = $data['description'];
            $todo->completed = $data['completed'];
            $todo->priority = $data['priority'];
            $todo->save();
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
        $data = request(['id']);
        $todo = Todos::find($data['id']);
        if ($todo != null){
            $todo->delete();
        }

    }
}
