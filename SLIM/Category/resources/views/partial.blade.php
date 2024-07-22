<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$categories->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Color</th>
        <th>Color code</th>
        <th>N. question</th>
        <th>Is Active</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $index => $category)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$category->name}}
            </td>

            <td class="text-secondary" data-label="Role" >
                <div contentditable="true"  style="background: {{$category->color}}" id="circle">
                    &ensp;
                </div>
            </td>
            <td class="text-secondary" data-label="Role" >
                <span> {{$category->color}}</span>
            </td>

            <td class="text-secondary" data-label="Role" >
                {{$category->number_question ?? 0}}
            </td>



            <td class="text-secondary" data-label="Role" >
                {{$category->is_active?  'Yes' :'No' }}
            </td>

            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a
                                name="{{$category->name}}"
                                is_active="{{$category->is_active}}"
                                color="{{$category->color}}"
                                href="{{route('category.update',$category->id)}}"
                                class="dropdown-item edit" data-bs-toggle="modal" data-bs-target="#modal-update-category">
                                edit
                            </a>
                            <a class="dropdown-item delete"
                               href="{{route('category.destroy',$category->id)}}">
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

{!! $categories->render() !!}

