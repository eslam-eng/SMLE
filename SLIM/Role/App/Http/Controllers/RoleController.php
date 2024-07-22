<?php

namespace SLIM\Role\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SLIM\Permission\Interfaces\PermissionServiceInterface;
use SLIM\Role\App\Http\Requests\RoleRequest;
use SLIM\Role\App\Http\Requests\RoleUpdateRequest;
use SLIM\Role\Interfaces\RoleServiceInterface;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected  RoleServiceInterface $roleService;
    protected  PermissionServiceInterface $permissionService;

    public function  __construct(RoleServiceInterface $roleService, PermissionServiceInterface $permissionService)
    {
        $this->roleService =$roleService;
        $this->permissionService =$permissionService;
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->withcount(['users'])->getAllPaginated($request->all(), 15);
        if($request->ajax())
            return view('role::partial',compact('roles'));
        return view('role::index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions =$this->permissionService->getAll();
        return view('role::create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $roleRequest)
    {
        $role=$this->roleService->create($roleRequest->all());
        $role->syncPermissions($roleRequest->permissions);
        return $this->index($roleRequest);
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
        $permissions =$this->permissionService->getAll();

        return view('role::edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $roleUpdateRequest, Role $role)
    {
        $this->roleService->update($role,$roleUpdateRequest->all());
        $role->syncPermissions($roleUpdateRequest->permissions);
        return $this->index($roleUpdateRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role,Request $request)
    {
        $this->roleService->delete($role);
        return $this->index($request);

    }
}
