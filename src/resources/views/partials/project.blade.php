<style>

#projects article.project.id-{{$project->id}}{
    background-color: {{$project->color}};
}

</style>

<article class="project id-{{$project->id}}" data-id="{{ $project->id }}">
    <header>
      <h3><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></h3>
      {{-- <a href="#" class="delete">&#10761;</a> --}}
    </header>
    <div class="content">
        @if($project->pivot->role == "Coordinator")
            <a href="/archive_project"><img src={{ asset('img/cardboard-box.png') }} width="25px"></a>
        @endif

        @if(!$project->pivot->favourite)
            <a href="#" class="fav"><img src={{ asset('img/star.png') }} width="25px"></a>
        @else
            <a href="#" class="fav"><img src={{ asset('img/filed_star.png') }} width="25px"></a>
        @endif
    </div>
</article>
