<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>Email</th>
        <th>Name</th>
        <th>Obs</th>
        <th>Password</th>
        <th>Img</th>
        <th>Is Admin</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->name !!}</td>
            <td>{!! $user->obs !!}</td>
            <td>{!! $user->img !!}</td>
            <td>{!! $user->is_admin !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', $user) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', $user) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>