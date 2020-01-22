<?php
namespace App\Services;

use App\Models\Todos;

class TodoServiceImpl implements TodoService{
    public function getAll(){
        $user = auth()->user();
        return $user->todos;
    }
    public function create($todo){
        $user = auth()->user();
        $createdTodo = Todos::create([
            'title' => $todo['title'],
            'description' => $todo['description'],
            'priority' => $todo['priority'],
            'completed' => $todo['completed'],
            'user_id' => $user->id
        ]);
        return $createdTodo;

    }
    public function delete($id){
        $todo = Todos::find($id);
        if ($todo != null){
            $todo->delete();
            return $id;
        }
        return null;

    }
    public function update($todoToEdit){
        $todo = Todos::find($todoToEdit['id']);
        if ($todo != null){
            $todo->title = $todoToEdit['title'];
            $todo->description = $todoToEdit['description'];
            $todo->completed = $todoToEdit['completed'];
            $todo->priority = $todoToEdit['priority'];
            $todo->save();
            return $todo;
        }

    }
}