<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $task;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(Task $task)
    {
        $this->middleware('auth');

        $this->task = $task;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_tasks = Task::where('user_id', Auth::id())->orderBy('date', 'DESC')->paginate(5);

        return view('tasks.home')
             ->with('all_tasks', $all_tasks);
    }
}
