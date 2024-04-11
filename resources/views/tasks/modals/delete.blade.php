<div class="modal fade" id="delete-task-{{ $task->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger w-100">
            <div class="modal-header border-danger">
                <div class="h5 modal-title text-danger fw-bold">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete Task
                </div>
            </div>
            <div class="modal-body text-center">
                <p class="fs-5 fw-bold">Are you sure you want to delete this task?</p>
                <div class="mt-3">
                    <p class="mt-1 text-muted">Date: {{ $task->date }}</p>
                    <p class="mt-1 text-muted">Task: {{ $task->task }}</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('task.destroy', $task->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>