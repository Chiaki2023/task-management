@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- Menu bar --}}
            @include('tasks.menu-bar')

            {{-- New Task + Task Lists --}}
            <div class="col-9">
                <form action="{{ route('task.store') }}" method="post">
                    @csrf

                    <div class="row mb-4">
                        <div class="col ">
                            <label for="task" class="form-label">Task</label>
                            <input type="text" name="task" id="task" value="{{ old('task') }}" class="form-control">
                            {{-- Error MSG --}}
                            @error('task')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control"> 
                            {{-- Error MSG --}}
                            @error('date')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror 
                        </div>
                        
                        <div class="col">
                            <label for="memo" class="form-label">Memo</label>
                            <textarea name="memo" id="memo" rows="1" class="form-control"></textarea>
                            {{-- Error MSG --}}
                            @error('memo')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror 
                        </div>
                        
                        <div class="col mt-auto">
                            <button type="submit" class="btn text-white fw-bold" style="background-color: #80bef2;">
                                <i class="fa-solid fa-circle-plus"></i> New Task
                            </button>
                        </div>
                    </div>
                </form>

                <table class="table table-hover align-middle mt-2">
                    <thead class="table-secondary">
                        <tr> 
                            <th>Date</th>
                            <th>Task</th>
                            <th>Memo</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>

                    @forelse ($all_tasks as $task)
                        <tbody>
                            <tr>
                                <td>{{ $task->date }}</td>
                                <td>{{ $task->task }}</td>
                                <td>{{ $task->memo }}</td>
                                <td>
                                    @if ($task->status == '1')
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-secondary fw-bold fs-6" data-bs-toggle="dropdown">
                                                Pending <i class="fa-solid fa-caret-down"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <form action="{{ route('task.edit', $task->id) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item text-primary">
                                                        <i class="fa-solid fa-circle-check"></i> Completed
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="badge bg-primary p-2 fs-6 text-wrap">Completed</div>
                                    @endif
                                </td>
                                <td>
                                    {{-- delete --}}
                                    <button type="button" class="btn fs-5 text-secondary" title="Delete"  data-bs-toggle="modal" data-bs-target="#delete-task-{{ $task->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                            {{-- Include modal here --}}
                            @include('tasks.modals.delete')
                    @empty
                            {{-- If the  site doesn't have any tasks yet. --}}
                            <tr class="text-center fs-6 fw-bold">
                                <td colspan="5" class="border-start border-end">
                                    <span class="text-primary fst-italic">
                                        Make your tasks up here and share with your friends! <i class="fa-solid fa-circle-up"></i> 
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    @endforelse
                </table>
                {{ $all_tasks->links() }}
            </div>
        </div>
    </div>
@endsection
