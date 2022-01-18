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
    </header>
    <div class="content">
        @if($project->pivot !== null && $project->pivot->role == "Coordinator"  && $project->archived_at == null)
            <img src={{asset("./img/help.png")}} width="20px" class="help">
        <span class="help-labels">You should archive the projects, where your are coordinator, when the project has finished, so that the information is mantained for future consultation, but no one can make any changes.</span>
            <a href="#" class="archive"><img alt="Not Archived" src={{ asset('img/cardboard-box.png') }} width="20px"></a>
        @elseif($project->pivot !== null && $project->pivot->role == "Coordinator" && $project->archived_at != null)
            <a href="#"><img alt="Archived" src={{ asset('img/cardboard-box-filled.png') }} width="20px"></a>
        @endif

        @if($project->pivot !== null && !$project->pivot->favourite)
            <a href="#" class="fav"><img alt="Not Favourited" src={{ asset('img/star.png') }} width="20px"></a>
        @elseif ($project->pivot !== null && $project->pivot->favourite)
            <a href="#" class="fav"><img alt="Favourited" src={{ asset('img/filed_star.png') }} width="20px"></a>
        @endif
    </div>
</article>
