<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$abbreviations->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Abbreviations Chars</th>
        <th>Abbreviations Words</th>
        <th>Is Active</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($abbreviations as $index => $abbreviation)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$abbreviation->char_abbreviations}}
            </td>

            <td class="text-secondary" data-label="Role" >
                {{$abbreviation->word_abbreviations}}
            </td>

            <td class="text-secondary" data-label="Role" >
                {{$abbreviation->is_active?  'Yes' :'No' }}
            </td>
            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a
                                char_abbreviations="{{$abbreviation->char_abbreviations}}"
                                word_abbreviations="{{$abbreviation->word_abbreviations}}"
                                description_abbreviations="{{$abbreviation->description_abbreviations}}"
                                is_active="{{$abbreviation->is_active}}"
                                href="{{route('abbreviation.update',$abbreviation->id)}}"
                                class="dropdown-item edit" data-bs-toggle="modal" data-bs-target="#modal-update-category">
                                edit
                            </a>
                            <a class="dropdown-item delete"
                               href="{{route('abbreviation.destroy',$abbreviation->id)}}">
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

{!! $abbreviations->render() !!}

