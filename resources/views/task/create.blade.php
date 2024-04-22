<x-app-layout>
    <div class="content">
        <h1 class="title">Create new task</h1>
        <center>
            <form action="{{ route('task.store') }}" method="POST" class="task-form">
                @csrf
                <textarea name="task" class="task-body" rows="10"></textarea>
                <input type="date" name="date"><br>
                <input type="time" name="time">
                <div class="option">
                    <a href="{{ route('task.index') }}" class="cancel-button">Cancel</a>
                    <button class="submit-button">Submit</button>
                </div>
            </form>
        </center>
    </div>
</x-app-layout>
