@extends('layouts.app')

@section('title', 'Friends' . ' Tasks')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- Menu bar --}}
            @include('tasks.menu-bar')

            {{-- Friends' Task List --}}
            <div class="col-6">
                <h1>{{ date('F j, Y') }}</h1>
                <p class="fs-4">Check your friends' achievements!</p>

                @forelse ($friend_tasks as $task)
                    <div class="mt-2 border border-2 rounded p-2">
                        {{-- avatar + name --}}
                        <div class="row align-items-center mb-1">
                            <div class="col-auto">
                                <a href="{{ route('profile', $task->user->id) }}">
                                    @if ($task->user->avatar)
                                        <img src="{{ $task->user->avatar }}" alt="{{ $task->user->name }}" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col-auto ps-0">
                                <a href="{{ route('profile', $task->user->id) }}" class="text-decoration-none text-dark fs-5 fw-bold">
                                    {{ $task->user->name }}
                                </a>
                            </div>
                            <div class="col ps-0">
                                {{ $task->updated_at->format('H:i') }}
                            </div>
                        </div>
                        {{-- Completed Tasks --}}
                        <div class="row align-items-center text-primary fs-5">
                            <div class="col-auto ms-1">
                                <i class="fa-solid fa-check"></i> {{$task->task}}
                            </div>
                            <div class="col text-truncate">
                                {{ $task->memo }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center" style="margin-top: 100px">
                        <h2>No friends achieved today's tasks yet.</h2>
                        <p class="fs-4 text-primary">Be the first to accomplish the task!</p>
                        <p class="fs-sm">No friends added yet? <br>You can follow new friends from the suggestions.</p>
                    </div>
                @endforelse
            </div>

            {{-- Friend Suggestion --}}
            <div class="col-3">
                @if ($suggested_users)
                <div class="row">
                    <div class="col">
                        <p class="fw-bold fs-4 text-secondary">Suggestions For You</p>
                    </div>
                </div>
                    @foreach ($suggested_users as $user)
                        <div class="row align-items-center mb-3">
                            <div class="col-auto">
                                <a href="{{ route('profile', $user->id) }}">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                    @endif
                                </a>
                            </div>

                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile', $user->id) }}" class="text-decoration-none text-dark fw-bold">
                                    {{ $user->name }}
                                </a>
                            </div>

                            <div class="col-auto">
                                <form action="{{ route('follow.store', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">
                                        Follow
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
