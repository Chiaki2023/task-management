<div class="col-3">
    <div class="list-group mb-3 mt-2">
        <a href="{{ route('home') }}" class="list-group-item fw-bold {{ request()->is('/') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Home
        </a>
    </div>

    <div class="list-group mb-3">
        {{-- All TODO --}}
        <a href="{{ route('task.pending') }}" class="list-group-item {{ request()->is('task/pending') ? 'active' : '' }}"> 
            <i class="fa-solid fa-bars"></i> All Tasks
        </a>

        {{-- Completed --}}
        <a href="{{ route('task.completed') }}" class="list-group-item {{ request()->is('task/completed') ? 'active' : '' }}">
            <i class="fa-solid fa-circle-check"></i> Completed
        </a>
    </div>

    <div class="list-group">
        <a href="{{ route('task.friend') }}" class="list-group-item {{ request()->is('task/friends') ? 'active' : '' }}">
            <i class="fa-solid fa-user-group"></i> Friends' Tasks
        </a>
    </div>
</div>