<li class="task" data-id="{{$task->id}}">
    <a href="/tasks/{{ $task->id }}" class="name">{{ $task->name }}</a>
    <span class="number">{{ $task->task_number+1 }}</span>
</li>
