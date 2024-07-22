<?php

namespace SLIM\Permission\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Permission\App\Http\Requests\PermissionRequest;
use SLIM\Permission\App\Http\Requests\PermissionUpdateRequest;
use SLIM\Permission\Interfaces\PermissionServiceInterface;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected  PermissionServiceInterface $permissionService;
    public function  __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService =$permissionService;
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionService->getAllPaginated($request->all(), 15);
        if($request->ajax())
            return view('permission::partial',compact('permissions'));
        return view('permission::index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $permissionRequest)
    {
        $this->permissionService->create($permissionRequest->all());
        return $this->index($permissionRequest);
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
    public function edit(Role $role)
    {
        return view('role::edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $permissionUpdateRequest, Permission $permission)
    {
        $this->permissionService->update($permission,$permissionUpdateRequest->all());
        return $this->index($permissionUpdateRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission, Request $request)
    {
        $this->permissionService->delete($permission);
        return $this->index($request);

    }
}
