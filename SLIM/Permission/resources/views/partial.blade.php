<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$permissions->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permissions as $index => $permission)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$permission->name}}
            </td>
            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a
                                name="{{$permission->name}}"
                                href="{{route('permission.update',$permission->id)}}"
                                class="dropdown-item edit" data-bs-toggle="modal" data-bs-target="#modal-update-permission">
                                edit
                            </a>
                            <a class="dropdown-item delete"
                               href="{{route('permission.destroy',$permission->id)}}">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

{!! $permissions->render() !!}

