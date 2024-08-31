<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$payments->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Is Active</th>
        <th>additional data</th>
        <th class="w-1">Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $index => $payment)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary" data-label="Role">
                {{$payment->name}}
            </td>
            <td class="text-secondary" data-label="Role">
                <div class="mb-3">
                    <label class="form-check form-switch">
                        <span class="form-check-label">{{$payment->is_active?  'Yes' :'No' }}</span>
                    </label>
                </div>

            </td>

            <td class="text-secondary" data-label="Role">
                <div class="mb-3">
                    @isset($payment->additional_data)
                        <ul>
                            @foreach($payment->additional_data as $key=>$value)
                                <li>{{$key ." : " . $value}}</li>
                            @endforeach
                        </ul>
                    @endisset
                </div>

            </td>


            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            @if(strtoupper($payment->name) == 'EXTERNAL')
                                <a
                                    name="{{$payment->name}}"
                                    is_active="{{$payment->is_active}}"
                                    href="{{route('payment.update',$payment->id)}}"
                                    class="dropdown-item edit" data-bs-toggle="modal"
                                    data-bs-target="#modal-update-payment">
                                    edit
                                </a>
                            @endif

                            <button

                                data-url="{{route('payment.change-status',$payment->id)}}"
                                class="dropdown-item change_status" data-bs-toggle="modal">
                                {{$payment->is_active?  'Deactivate' :'Activate' }}
                            </button>

                        </div>
                    </div>
                </div>
            </td>

        </tr>
    @endforeach
    </tbody>

</table>

{!! $payments->render() !!}

