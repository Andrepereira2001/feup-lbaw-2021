<table class="table table-responsive" id="works-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Obs</th>
        <th>Img</th>
        <th>Year</th>
        <th>Id User</th>
        <th>Id Collection</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($works as $work)
        <tr>
            <td>{!! $work->title !!}</td>
            <td>{!! $work->obs !!}</td>
            <td>{!! $work->img !!}</td>
            <td>{!! $work->year !!}</td>
            <td>{!! $work->id_user !!}</td>
            <td>{!! $work->id_collection !!}</td>
            <td>
                {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('works.show', [$work->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('works.edit', [$work->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>