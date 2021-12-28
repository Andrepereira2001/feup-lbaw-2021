<li class="task" data-id="{{$task->id}}">
    <a href="/tasks/{{ $task->id }}" class="name">{{ $task->name }}</a>
    <span class="number">{{ $task->task_number+1 }}</span>
    {{-- <a href="#" class="delete">&#10761;</a> --}}
</li>
