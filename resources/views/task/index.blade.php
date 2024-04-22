<x-app-layout>
    <div class="body">
        <center><a href="{{ route('task.create') }}" class="button-addTask">Add Task</a></center>
        @foreach ($tasks as $task)
            <div class="task">
                <div class="task-body">
                    {{ Str::words($task->task) }}
                </div> <!-- Close note-body div -->
                <div class="deadline">
                    <p>Due at:</p>
                    <span class="time">{{ $task->time }}</span>
                    <p class="date">{{ $task->date }}</p>
                </div>
                <div class="option">
                    <form action="{{ route('task.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button-complete" onclick="confirmMarkAsComplete(event)">Mark as complete</button>
                    </form>
                    <a href="{{ route('task.edit', $task) }}" class="button-edit">Edit</a>
                    <form action="{{ route('task.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="button-delete">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function confirmMarkAsComplete(event) {
            event.preventDefault(); // Prevent the default button click behavior

            if (confirm("Mark this task as complete will delete it, are you sure?")) {
                // If the user confirms, submit the form
                event.target.closest('form').submit();
            }
        }
    </script>
</x-app-layout>
