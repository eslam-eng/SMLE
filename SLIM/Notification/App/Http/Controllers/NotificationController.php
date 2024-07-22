<?php

namespace SLIM\Notification\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Notification\App\Http\Requests\NotificationRequest;
use SLIM\Notification\App\Models\Notification;
use SLIM\Notification\Interfaces\NotificationServiceInterface;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected NotificationServiceInterface $notificationService;
    public function  __construct(NotificationServiceInterface $notificationService)
    {
        $this->notificationService=$notificationService;

    }

    public function index(Request $request)
    {
        $notifications = $this->notificationService->getAllPaginated($request->all(), 15);
        if($request->ajax())
            return view('notification::partial',compact('notifications'));
        return view('notification::index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NotificationRequest $notificationRequest)
    {
        $this->notificationService->create($notificationRequest->all());
        return $this->index($notificationRequest);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('category::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NotificationRequest $notificationRequest, Notification $notification)
    {
        $this->notificationService->update($notification,$notificationRequest->all());
        return $this->index($notificationRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification, Request $request)
    {
        $this->notificationService->delete($notification);
        return $this->index($request);

    }
}
