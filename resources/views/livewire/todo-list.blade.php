<div class="container mt-5">
    @if($successMessage)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $successMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row mb-3">
        <div class="col-md-12">
            <input type="text" wire:model="title" class="form-control mb-2" placeholder="Enter task name">
            <input type="text" wire:model="text" class="form-control mb-2" placeholder="Enter task description">
            <button wire:click="addTask" class="btn btn-primary w-100">Add Task</button>
        </div>
    </div>
    @if($editTaskId)
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="border border-secondary rounded-3 p-4 mb-3">
                    <h4 class="mb-3">Editing Task</h4>
                    <input type="text" wire:model="editTitle" class="form-control mb-2" placeholder="Edit task name">
                    <input type="text" wire:model="editText" class="form-control mb-2" placeholder="Edit task description">
                    <div class="mb-2">
                        <input type="text" wire:model="newTag" class="form-control" placeholder="Add new tag">
                        <button wire:click="addTagToTask({{ $editTaskId }})" class="btn btn-sm btn-info mt-2">Add Tag</button>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        @foreach($currentTags as $tag)
                            <div class="d-flex align-items-center bg-secondary rounded-pill p-2">
                                <span class="me-2 text-white">{{ $tag->title }}</span>
                                <button wire:click="removeTag({{ $editTaskId }}, {{ $tag->id }})" class="btn btn-sm btn-danger p-0" style="line-height: 1;">×</button>
                            </div>
                        @endforeach
                    </div>
                    <button wire:click="updateTask" class="btn btn-success w-100 mb-2">Update Task</button>
                    <button wire:click="cancelEdit" class="btn btn-secondary w-100">Cancel</button>
                </div>
            </div>
        </div>
    @endif
    <ul wire:sortable="saveOrder" class="list-group">
        @forelse($tasks as $task)
            <li wire:sortable.item="{{ $task->id }}" class="list-group-item d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column w-100">
                    <h5>{{ $task->title }}</h5>
                    <p class="mb-0">{{ $task->text }}</p>
                    <div class="mt-2 d-flex flex-wrap gap-2">
                        @foreach($task->tags as $tag)
                            <div class="d-flex align-items-center bg-secondary rounded-pill px-3 py-1">
                                <span class="me-2 text-white">{{ $tag->title }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div>
                    <button wire:click="editTask({{ $task->id }})" class="btn btn-sm btn-warning">Edit</button>
                    <button wire:click="deleteTask({{ $task->id }})" class="btn btn-sm btn-danger">Delete</button>
                </div>
            </li>
        @empty
            <li class="list-group-item">No tasks available.</li>
        @endforelse
    </ul>
</div>
