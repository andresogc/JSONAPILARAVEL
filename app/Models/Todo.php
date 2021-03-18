<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
class Todo extends Model
{
    use HasFactory;


    public function getUserTodos($userId){
        $userTodos= HTTP::get('https://jsonplaceholder.typicode.com/todos?userId='.$userId);
        
        $userTodosArray= $userTodos->json();
        return $userTodosArray;
    }


    public function saveTodo($data){

        $userId=$data->userId;
        //
        $todoSave = HTTP::post('https://jsonplaceholder.typicode.com/todos',[
            'userId' => $userId,
            'title' => $data->title,
            'completed' => false,
        ]);

        $userTodo = $todoSave->json();
        return $userTodo;
        
    }

    public function getUserTodo($id){
        
        $todo= HTTP::get('https://jsonplaceholder.typicode.com/todos/'.$id);
        $todoArray= $todo->json();

        return $todoArray;
    }


    public function todoUpdate($request){
        $userId=$request->userId;
        $id=$request->id;
        $title=$request->title;
        $completed=$request->completed;
        //
        $todoSave = HTTP::put('https://jsonplaceholder.typicode.com/todos/'.$id,[
            'userId' => $userId,
            'title' => $title,
            'completed' => $completed,
        ]);

        $userTodo = $todoSave->json();
            
        return $userTodo;
    }


    public function todoDelete($request){
        $id=$request->id;

        $todoDel= HTTP::get('https://jsonplaceholder.typicode.com/todos/'.$id);
        $todoDel= $todoDel->json();

        return $todoDel;
    }

}
