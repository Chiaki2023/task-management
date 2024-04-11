<div class="modal fade" id="following-{{ $user->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            @if ($user->followingID->isNotEmpty())
                <div class="row justify-content-center">
                    <div class="col-8 my-2">
                        <h3 class="text-muted text-center">Following</h3>

                        @foreach ($user->followingID as $following)
                            <div class="row align-items-center mt-3">
                                <div class="col-auto">
                                    <a href="{{ route('profile', $following->following_id) }}">
                                        @if ($following->followingUser->avatar)
                                            <img src="{{ $following->followingUser->avatar }}" alt="{{ $following->followingUser->name }}" class="rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </a>
                                </div>

                                <div class="col ps-0 text-truncate">
                                    <a href="{{ route('profile', $following->following_id) }}" class="text-decoration-none text-dark fw-bold">
                                        {{ $following->followingUser->name }}
                                    </a>
                                </div>

                                <div class="col-auto text-end">
                                    @if ($following->following_id != Auth::user()->id)
                                        @if ($following->followingUser->isFollowed())
                                            <form action="{{ route('follow.destroy', $following->following_id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">
                                                    Following
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('follow.store', $following->following_id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">
                                                    Follow
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h3 class="text-muted text-center">No Following Yet</h3>
            @endif
        </div>
    </div>
</div>