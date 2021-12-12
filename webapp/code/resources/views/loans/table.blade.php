<table class="table table-responsive" id="loans-table">
    <thead>
        <tr>
            <th>Id Item</th>
        <th>Id User</th>
        <th>Start</th>
        <th>End</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{!! $loan->id_item !!}</td>
            <td>{!! $loan->id_user !!}</td>
            <td>{!! $loan->start !!}</td>
            <td>{!! $loan->end !!}</td>
            <td>
                {!! Form::open(['route' => ['loans.destroy', $loan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('loans.show', [$loan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('loans.edit', [$loan->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>