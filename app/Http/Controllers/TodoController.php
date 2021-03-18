<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MOdels\User;
use App\MOdels\Todo;

class TodoController extends Controller
{   


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        $user = new User();
        $todo = new Todo();

        $userTodosArray=$todo->getUserTodos($userId);
        $userArray=$user->getUser($userId);
       
        return view('./todo/show',compact('userTodosArray','userArray'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $userTodo=$todo->saveTodo($request);
        return $userTodo;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {   

        $todo = new Todo();
        $todoArray = $todo->getUserTodo($id);

        return $todoArray;
       
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $todo = new Todo();
        $userTodo=$todo->todoUpdate($request); 

        return $userTodo;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
       $todo=new Todo();
       $todoDel=$todo->todoDelete($request);

        return $todoDel;

    }
}
