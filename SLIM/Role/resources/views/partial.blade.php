<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$roles->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>

        <th>#</th>
        <th>Name</th>
        <th>Created At</th>
        <th>No. users</th>
        <th>Is Active</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $index => $role)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$role->name}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{\Carbon\Carbon::parse($role->created_at)->format('Y-m-d')}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$role->users_count}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$role->is_active?  'Yes' :'No' }}
            </td>
            <td>
                @if($role->name != 'Super Admin')
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a
                                    href="{{route('role.edit',$role->id)}}"
                                    class="dropdown-item">
                                    edit
                                </a>

                                <a class="dropdown-item delete"
                                   href="{{route('role.destroy',$role->id)}}">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>

</table>

{!! $roles->render() !!}

