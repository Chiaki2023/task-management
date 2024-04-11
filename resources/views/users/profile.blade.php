@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- Menu bar --}}
            @include('tasks.menu-bar')

            <div class="col-9">
                <div class="row mb-3">
                    {{-- profile avatar --}}
                    <div class="col-4">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle d-block mx-auto avatar-lg">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
                        @endif
                    </div>
                
                    {{-- profile info --}}
                    <div class="col-8">
                        <div class="row mb-4">
                            {{-- name --}}
                            <div class="col-auto mt-3">
                                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
                            </div>
                
                            {{-- Action buttons: edit/follow/following --}}
                            <div class="col-auto p-2 mt-3">
                                @if (Auth::user()->id === $user->id)
                                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit Profile</a>
                                @else
                                    @if ($user->isFollowed())
                                        {{-- follow user --}}
                                        <form action="{{ route('follow.destroy', $user->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                                        </form>
                                    @else
                                        {{-- unfollow user --}}
                                        <form action="{{ ROUTE('follow.store', $user->id) }}" method="post" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                
                        <div class="row mb-3">                
                            {{-- followers --}}
                            <div class="col-auto">
                                <button class="btn text-dark" data-bs-toggle="modal" data-bs-target="#followers-{{ $user->id }}">
                                    <strong>{{ $user->followersID->count() }}</strong> {{ $user->followersID->count() == 1 ? 'Follower' : 'Followers' }} 
                                </button>
                            </div>
                            {{-- Include modal here --}}
                            @include('users.modals.followers')
                
                            {{-- following --}}
                            <div class="col-auto">
                                <button class="btn text-dark" data-bs-toggle="modal" data-bs-target="#following-{{ $user->id }}">
                                    <strong>{{ $user->followingID->count() }}</strong> Following 
                                </button>
                            </div>
                            {{-- Include modal here --}}
                            @include('users.modals.following')
                        </div>
                    </div>
                </div>

                <div class="row ms-5 me-5">
                    {{-- Intoroduction --}}
                    <p class="fw-bold">{{ $user->introduction }}</p>
                </div>

                {{-- tasks & achievements --}}
                <div class="col-6 border rounded fs-4 ms-5 mt-5 p-2 bg-info text-light">
                    <strong>{{ $user->name }}</strong> has created <strong>{{ $user->tasks->count() }} {{ $user->tasks->count() == 1 ? 'task' : 'tasks' }}</strong>, and<br>
                    has <strong>successfully completed {{ $user->tasks()->where('status', 2)->count() }}</strong> of them!
                </div>
            </div>
        </div>
    </div>
@endsection