<span class="btn btn-dark" style="margin:10px 10px 10px 10px">Total ({{$messages->total()}})</span>

<table
    class="table table-vcenter table-mobile-md card-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>E-mail</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Rate</th>
        <th>Message</th>
        <th>Created At</th>
        <th>Control</th>
    </tr>
    </thead>
    <tbody>
    @foreach($messages as $index => $message)
        <tr>
            <td class="text-secondary">
                {{++$index}}
            </td>
            <td class="text-secondary">
                {{$message->trainee->user_name}}
            </td>

            <td class="text-secondary" >
                {{$message->trainee->email}}
            </td>
            <td class="text-secondary" >
                {{$message->trainee->phone}}
            </td>

            <td class="text-secondary"  >
                {{$message->is_read ?  'Read' :'unRead' }}
            </td>
            <td class="text-secondary" data-label="Role" >
                {{$message->rate  }}
            </td>

            <td class="text-secondary" >
                Message
            </td>

            <td class="text-secondary" >
                {{\Carbon\Carbon::parse($message->created_at)->format('Y-m-d')}}
            </td>

            <td>
                <div class="btn-list flex-nowrap">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a
                                href=""
                                id="{{$message->id}}"
                                class="dropdown-item read">
                                {{$message->is_read ?  'unRead' :'Read' }}

                            </a>
                            <a
                                message="{{$message->message}}"
                                class="dropdown-item showMessage" data-bs-toggle="modal" data-bs-target="#modal-message">
                                Message

                            </a>


                            <a class="dropdown-item delete"
                               href="{{route('message.destroy',$message->id)}}">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </td>


        </tr>
    @endforeach
    </tbody>

    @include('message::message_model')
</table>

{!! $messages->render() !!}

