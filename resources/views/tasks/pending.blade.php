@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- Menu bar --}}
            @include('tasks.menu-bar')

            <div class="col-9">
                <table class="table table-hover align-middle mt-2">
                    <thead class="table-info">
                        <tr> 
                            <th>Date</th>
                            <th>Task</th>
                            <th>Memo</th>
                        </tr>
                    </thead>

                    @forelse ($pending_tasks as $task)
                        <tbody>
                            <tr>
                                <td>{{ $task->date }}</td>
                                <td>{{ $task->task }}</td>
                                <td>{{ $task->memo }}</td>
                            </tr>
                    @empty
                            {{-- If the site doesn't have any tasks yet. --}}
                            <tr class="text-center fs-6">
                                <td colspan="5" class="border-start border-end">
                                    <span class="text-primary fst-italic">
                                        No pending tasks yet.
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection