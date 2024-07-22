<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$subscribes->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
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
                {{$subscribe->full_name}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe['packages'][0]['name']}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe['packages'][0]['pivot']['amount']}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{\SLIM\Trainee\App\Models\Trainee::PAYMENT_TYPE[$subscribe['packages'][0]['pivot']['package_type']]}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe['packages'][0]['pivot']['payment_method']}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe['packages'][0]['pivot']['start_date']}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$subscribe['packages'][0]['pivot']['end_date']}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{\SLIM\Trainee\App\Models\Trainee::PAID_STATUS[$subscribe['packages'][0]['pivot']['is_paid']]}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{\SLIM\Trainee\App\Models\Trainee::ACTIVE_STATUS[$subscribe['packages'][0]['pivot']['is_active']]}}
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

