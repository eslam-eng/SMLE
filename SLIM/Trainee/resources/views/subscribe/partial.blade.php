<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$subscribes->total()}})</span>

<table
    class="table table-vcenter table-bordered table-mobile-md card-table">
    <thead>
    <tr>

        <th>#</th>
        <th>T.name</th>
        <th>P.name</th>
        <th>Price</th>
        <th>Subscribe Type</th>
        <th>Payment Way</th>
        <th>S.start Date</th>
        <th>S.end Date</th>
        <th>Is Paid</th>
        <th>Is Active</th>
        <th>specialists</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($subscribes as $index => $subscribe)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->trainee->full_name}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->package->name}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->amount}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->package_type=='m' ? "Monthly" : 'Yearly'}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->payment_method}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->start_date}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->end_date}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->is_paid ? 'yes' : 'no'}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe->is_active ? 'yes' : 'no'}}
            </td>
            <td class="text-secondary" data-label="Role" >
                @foreach($subscribe->tranineeSubscribeSpecialization as $subscribeSpecialist)
                    {{implode(',',$subscribe->tranineeSubscribeSpecialization->pluck('specialist.name')->toArray())}}
                @endforeach
            </td>
            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a
                                href="{{route('subscribe-trainee.edit',$subscribe->id)}}"
                                class="dropdown-item">
                                edit
                            </a>
                            <a class="dropdown-item delete"
                               href="{{route('subscribe-trainee.destroy',$subscribe->id)}}">
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

{!! $subscribes->render() !!}

