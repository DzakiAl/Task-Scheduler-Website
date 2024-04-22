<x-app-layout>
    <div class="content">
        <h1 class="title">Edit task</h1>
        <center>
            <form action="{{ route('task.update', $task) }}" method="POST" class="task-form">
                @csrf
                @method('PUT')
                <textarea name="task" class="task-body" rows="10">{{ $task->task }}</textarea>
                <input type="time" name="time" value="{{ $task->time }}"><br>
                <input type="date" name="date" value="{{ $task->date }}">
                <div class="option">
                    <a href="{{ route('task.index') }}" class="cancel-button">Cancel</a>
                    <button class="submit-button">Submit</button>
                </div>
            </form>
        </center>
    </div>
</x-app-layout>
