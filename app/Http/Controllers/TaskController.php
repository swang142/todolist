<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orchid\TaskScreen;
class TaskController extends Controller
{
    public function index(){
        return view('tasks.index');
    }

    public function create(){

    }

    public function store(Request $request){
        $this-> validate($request, ['newTaskName' => 'required|min:5|max:255',]);
        $task= new TaskScreen;
        $task ->name = $request ->taskName;
    }
}
