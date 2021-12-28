<li class="taskDone" data-id="{{$task->id}}">
    <a href="/tasks/{{ $task->id }}" class="number">{{ $task->task_number +1 }} <span class="name">{{ $task->name }}</span></a>
    {{-- <a href="#" class="delete">&#10761;</a> --}}
</li>
