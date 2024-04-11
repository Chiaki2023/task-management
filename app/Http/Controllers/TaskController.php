<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private $task;
    private $user;

    public function __construct(Task $task, User $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required',
            'date' => 'required',
            'memo' => 'max:100',
        ]);

        $this->task->user_id = Auth::user()->id;
        $this->task->task = $request->task;
        $this->task->date = $request->date;
        $this->task->memo = $request->memo;
        $this->task->save();

        return redirect()->back();
    }

    public function editStatus($id)
    {        
        $task = $this->task->findOrFail($id);
        $task->status = '2';
        $task->save();

        return redirect()->back();
    }

    public function showPending()
    {
        $user = Auth::user();
        $pending_tasks = $user->tasks->where('status', '1');

        return view('tasks.pending')
            ->with('pending_tasks', $pending_tasks);
    }

    public function showCompleted()
    {
        $user = Auth::user();
        $completed_tasks = $user->tasks->where('status', '2');


        return view('tasks.completed')
            ->with('completed_tasks', $completed_tasks);
    }

    # get tasks of friends that the Auth user is following
    public function getFriendTask()
    {
        $tasks_today = $this->task
            ->whereDate('date', now())
            ->where('status', 2) 
            ->orderBy('updated_at', 'DESC')
            ->get();

        $friend_tasks = [];

        foreach ($tasks_today as $task) {
            if ($task->user->isFollowed()) {
                $friend_tasks[] = $task;
            }
        }
        return $friend_tasks;
    }



    public function showFriendTask()
    {
        $friend_tasks = $this->getFriendTask();

        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach ($all_users as $user){
            if (!$user->isFollowed()){
                $suggested_users[] = $user;
            }
        }

        return view('tasks.friend')
            ->with('friend_tasks', $friend_tasks)
            ->with('suggested_users', $suggested_users);
    }

    public function destroy($id)
    {
        $this->task->destroy($id);

        return redirect()->route('home');
    }
}
