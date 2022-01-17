<?php
    $projectColor = "{$project->color}cc";
?>

<style>

#projects article.project.id-{{$project->id}}{
    background-color: {{$projectColor}};
}

</style>

<article class="project id-{{$project->id}}" data-id="{{ $project->id }}">
    <header>
      <h3><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></h3>
      {{-- <a href="#" class="delete">&#10761;</a> --}}
    </header>
    <div class="content">
        @if($project->pivot !== null && $project->pivot->role == "Coordinator"  && $project->archived_at == null)
            <a href="#" class="archive"><img src={{ asset('img/cardboard-box.png') }} width="20px"></a>
        @elseif($project->pivot !== null && $project->pivot->role == "Coordinator" && $project->archived_at != null)
            <a href="#"><img src={{ asset('img/cardboard-box-filled.png') }} width="20px"></a>
        @endif

        @if($project->pivot !== null && !$project->pivot->favourite)
            <a href="#" class="fav"><img src={{ asset('img/star.png') }} width="20px"></a>
        @elseif ($project->pivot !== null && $project->pivot->favourite)
            <a href="#" class="fav"><img src={{ asset('img/filed_star.png') }} width="20px"></a>
        @endif
    </div>
</article>
