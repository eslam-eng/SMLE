<?php

namespace SLIM\Admin\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SLIM\Admin\App\Http\Requests\AdminRequest;
use SLIM\Admin\App\Http\Requests\AdminUpdateRequest;
use SLIM\Admin\service\AdminService;
use SLIM\Role\service\RoleService;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private AdminService $adminService;
    private RoleService $roleService;

    public function __construct(AdminService $adminService, RoleService $roleService

    )
    {
        $this->adminService = $adminService;
        $this->roleService  = $roleService;
    }

    public function index(Request $request)
    {
        $admins = $this->adminService->getAllPaginated($request->all(), 15);
        $roles  = $this->roleService->getAll();

        if ($request->ajax())
        {
            return view('admin::partial', compact('admins'));
        }

        return view('admin::index', compact('admins', 'roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = $this->roleService->getAll();
        return view('admin::create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $adminRequest)
    {
        $adminRequest->merge(['password' => Hash::Make($adminRequest->password)]);
        $user = $this->adminService->create($adminRequest->all());
        $user->syncRoles($adminRequest->role);

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        abort(404);
        return view('abbreviation::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = User::findorfail($id);
        $roles = $this->roleService->getAll();
        return view('admin::edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $adminUpdateRequest, $id)
    {
        $user = User::findorfail($id);

        if ($adminUpdateRequest->has('password'))
        {
            $adminUpdateRequest->merge(['password' => Hash::Make($adminUpdateRequest->password)]);
        }
        else
        {
            $adminUpdateRequest->merge(['password' => $user->password]);
        }

        $this->adminService->update($user, $adminUpdateRequest->all());
        $user->syncRoles($adminUpdateRequest->role);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        User::find($id)->delete();
        return $this->index($request);

    }

}
