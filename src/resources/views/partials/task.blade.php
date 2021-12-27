<li class="task" data-id="{{$task->id}}">
    <a href="/tasks/{{ $task->id }}" class="name">{{ $task->name }}</a>
    <span class="number">{{ $task->id }}</span>
    {{-- <a href="#" class="delete">&#10761;</a> --}}
</li>
