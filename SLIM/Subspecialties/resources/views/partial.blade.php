<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$subSpecializations->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>specialist</th>
        <th>N. question</th>
{{--        <th>N. User</th>--}}
        <th>Is Active</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subSpecializations as $subSpecialization)
        <tr>
            <td class="text-secondary">
                {{$subSpecialization->name}}
            </td>
            <td class="text-secondary">
                {{$subSpecialization->specialist->name}}
            </td>
            <td class="text-secondary" >
                {{$subSpecialization->questions()->count() ?? 0}}
            </td>

{{--            <td class="text-secondary">--}}
{{--                {{$subSpecialization->number_user ?? 0}}--}}
{{--            </td>--}}

            <td class="text-secondary" >
                {{$subSpecialization->is_active?  'Yes' :'No' }}
            </td>

            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a
                                name="{{$subSpecialization->name}}"
                                is_active="{{$subSpecialization->is_active}}"
                                specialist_id="{{$subSpecialization->specialist_id}}"
                                href="{{route('subspecialties.update',$subSpecialization->id)}}"
                                class="dropdown-item sub-edit" data-bs-toggle="modal" data-bs-target="#modal-update-sub-specialization">
                                edit
                            </a>
                            <a class="dropdown-item delete" href="{{route('subspecialties.destroy',$subSpecialization->id)}}">
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

{!! $subSpecializations->render() !!}

