<?php

namespace SLIM\Message\App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use Illuminate\Http\Response;
use SLIM\Traits\GeneralTrait;

class MessageController extends Controller
{
        use GeneralTrait;

    public function store(MessageRequest $messageRequest)
    {
          auth()->user()->messages()->create($messageRequest->all());
              return $this->returnSuccessMessage('created Successfully');
    }
}
