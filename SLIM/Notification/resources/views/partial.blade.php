<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$notifications->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Notification</th>
        <th>Created At</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($notifications as $index => $notification)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$notification->title}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$notification->notification}}
            </td>

            <td class="text-secondary" data-label="Role" >
                {{\Carbon\Carbon::parse($notification->created_at)->format('Y-m-d')}}
            </td>


            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item delete"
                               href="{{route('notification.destroy',$notification->id)}}">
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

{!! $notifications->render() !!}

