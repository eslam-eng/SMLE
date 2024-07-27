<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$admins->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>

        <th>#</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Role</th>
        <th>Is Active</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($admins as $index => $admin)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary">
                {{$admin->name}}
            </td>
            <td class="text-secondary">
                {{$admin->email}}
            </td>

            <td class="text-secondary">
                {{ implode(' ',$admin->roles()->pluck('name')->toArray()) }}
            </td>

            <td class="text-secondary">
                {{$admin->is_active?  'Yes' :'No' }}
            </td>
            <td>
                @if(!in_array('Super Admin',$admin->roles()->pluck('name')->toArray()))
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a
                                    href="{{route('admin.edit',$admin->id)}}"
                                    class="dropdown-item">
                                    edit
                                </a>
                                <a class="dropdown-item delete"
                                   href="{{route('admin.destroy',$admin->id)}}">
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

{!! $admins->render() !!}

