<h3 class="text-dark" style="margin:10px">Total ({{$specializations->total()}})</h3>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>N. question</th>
        <th>N. User</th>
        <th>Is Active</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($specializations as $index => $specialization)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$specialization->name}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$specialization->questions_count}}
            </td>

            <td class="text-secondary" data-label="Role" >
                {{$specialization->subscribes_count}}
            </td>

            <td class="text-secondary" data-label="Role" >
                {{$specialization->is_active?  'Yes' :'No' }}
            </td>

            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a
                                name="{{$specialization->name}}"
                                is_active="{{$specialization->is_active}}"
                                href="{{route('specialization.update',$specialization->id)}}"
                                class="dropdown-item edit" data-bs-toggle="modal" data-bs-target="#modal-update-specialization">
                                edit
                            </a>
                            <a class="dropdown-item delete"
                               href="{{route('specialization.destroy',$specialization->id)}}">
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

{{ $specializations->links() }}

