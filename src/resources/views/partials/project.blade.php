<article class="project" data-id="{{ $project->id }}">
    <header>
      <h2><a href="/projects/{{ $project->id }}">{{ $project->name }}</a></h2>
      <a href="#" class="delete">&#10761;</a>
    </header>
    <div class="content">
        <a href="{{ url('/archive_project') }}"><img src={{ asset('img/cardboard-box.png') }} width="20px"></a>
        <a href="{{ url('/favourite_project') }}"><img src={{ asset('img/star.png') }} width="20px"></a>
    </div>
    <!-- <ul>
      3@each('partials.item', $project->items()->orderBy('id')->get(), 'item')
    </ul>
    <form class="new_item">
      <input type="text" name="description" placeholder="new item">
    </form>-->
    </article>
