<?php

namespace SLIM\Message\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Constants\App;
use SLIM\Message\App\Models\Message;
use SLIM\Message\Interfaces\MessageServiceInterfaces;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        protected MessageServiceInterfaces $messageServiceInterfaces;
      public function __construct(MessageServiceInterfaces $messageServiceInterfaces)
      {
          $this->messageServiceInterfaces=$messageServiceInterfaces;
      }

    public function index(Request $request)
    {
        $messages= $this->messageServiceInterfaces->with(['trainee'])->getAllPaginated($request->all(),App::PAGINATE_LENGTH);
          if($request->ajax())
              return view('message::partial',compact('messages'));
                return view('message::index',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('message::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('message::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('message::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message,Request $request)
    {
        $this->messageServiceInterfaces->delete($message);
        return  $this->index($request);
    }
   public function seenMessage(Request $request)
   {

       $message=Message::where('id',$request->message_id)->first();
      $message->update([
         'is_read' =>!$message->is_read
      ]);

      return  $this->index($request);
   }

}
