<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$payments->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Is Active</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $index => $payment)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$payment->name}}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$payment->is_active?  'Yes' :'No' }}
            </td>
            @if(strtoupper($payment->name) == 'EXTERNAL')
                <td>
                    <div class="btn-list flex-nowrap">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                                Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a
                                    name="{{$payment->name}}"
                                    is_active="{{$payment->is_active}}"
                                    href="{{route('payment.update',$payment->id)}}"
                                    class="dropdown-item edit" data-bs-toggle="modal" data-bs-target="#modal-update-payment">
                                    edit
                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            @endif

        </tr>
    @endforeach
    </tbody>

</table>

{!! $payments->render() !!}

