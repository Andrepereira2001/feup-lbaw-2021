<style>

    #notification article.notification.id-{{$notification->id}}{
        background-color: {{$notification->color}};
    }

    </style>

    <article class="notification id-{{$notification->id}}" data-id="{{ $notification->id }}">
        <header>
          <h3><a href="/notification/{{ $notification->id }}">{{ $notification->name }}</a></h3>
          {{-- <a href="#" class="delete">&#10761;</a> --}}
        </header>
        <div class="content">

        </div>
    </article>
