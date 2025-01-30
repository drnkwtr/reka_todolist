<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Tag;
use Livewire\Component;
use Livewire\Attributes\On;

class TodoList extends Component
{
    public $title;
    public $text;
    public $tasks;
    public $editTaskId = null;
    public $editTitle;
    public $editText;
    public $newTag;
    public $currentTags = [];
    public $successMessage = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'text' => 'required|string|max:255',
        'editTitle' => 'required|string|max:255',
        'editText' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->refreshTasks();
    }

    public function addTask()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:255',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'text' => $this->text,
            'order' => Task::first() ? Task::max('order') + 1 : 1,
        ]);

        $this->reset(['title', 'text']);
        $this->showSuccessMessage('Task added successfully!');
        $this->refreshTasks();
    }

    public function editTask($taskId)
    {
        $task = Task::find($taskId);
        $this->editTaskId = $task->id;
        $this->editTitle = $task->title;
        $this->editText = $task->text;
        $this->currentTags = $task->tags;
    }

    public function updateTask()
    {
        $this->validate([
            'editTitle' => 'required|string|max:255',
            'editText' => 'required|string|max:255',
        ]);

        $task = Task::find($this->editTaskId);
        $task->update([
            'title' => $this->editTitle,
            'text' => $this->editText,
        ]);

        $this->cancelEdit();
        $this->showSuccessMessage('Task updated successfully!');
        $this->refreshTasks();
    }

    public function cancelEdit()
    {
        $this->reset(['editTaskId', 'editTitle', 'editText', 'newTag', 'currentTags']);
    }

    public function deleteTask($taskId)
    {
        Task::find($taskId)->delete();
        $this->showSuccessMessage('Task deleted successfully!');
        $this->refreshTasks();
    }

    public function addTagToTask($taskId)
    {
        $this->validate([
            'newTag' => 'required|string|max:255',
        ]);

        $task = Task::find($taskId);
        $tag = Tag::firstOrCreate(['title' => $this->newTag, 'user_id' => auth()->id()]);
        $task->tags()->syncWithoutDetaching($tag->id);

        $this->reset(['newTag']);
        $this->currentTags = $task->fresh()->tags;
        $this->showSuccessMessage('Tag added successfully!');
    }

    public function removeTag($taskId, $tagId)
    {
        $task = Task::find($taskId);
        $task->tags()->detach($tagId);
        $this->currentTags = $task->fresh()->tags;
        $this->showSuccessMessage('Tag removed successfully!');
    }

    #[On('saveOrder')]
    public function saveOrder($order)
    {
        foreach ($order as $task) {
            Task::where('id', $task['value'])->update(['order' => $task['order']]);
        }
        $this->refreshTasks();
    }

    private function refreshTasks()
    {
        $this->tasks = Task::where('user_id', auth()->user()->id)->orderBy('order')->get();
    }

    private function showSuccessMessage($message)
    {
        $this->successMessage = $message;
        $this->dispatch('clear-success-message');
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
