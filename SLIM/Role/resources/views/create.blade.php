@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center"></div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form class="card" id="createForm">
                            @csrf
                            <div class="card-body">
                                <h3 class="card-title">Add New Role</h3>
                                <div class="row row-cards">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Role Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Role Name">
                                        </div>
                                      </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">status</label>
                                            <select class="form-control" name="is_active">
                                                <option disabled="disabled" selected>select status</option>
                                                <option value="1">Active</option>
                                                <option value="0">In Active</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-check">
                                    <input class="form-check-input checkAll" name="check_all" type="checkbox"  id="checkAll">
                                    <label class="form-check-label" for="checkAll">
                                        All Permissions
                                    </label>
                                </div>
                                <hr>
                                <div class="row row-cards">
                                    @foreach($permissions as $permission)
                                    <div class="col-md-3" >
                                        <div class="form-check">
                                            <input class="form-check-input" style="cursor:pointer;" name="permissions[]" type="checkbox" value="{{$permission->name}}" id="permission_{{$permission->id}}">
                                            <label style="cursor:pointer;" class="form-check-label" for="permission_{{$permission->id}}">
                                                {{$permission->name}}
                                            </label>
                                        </div>
                                    </div>
                                        @endforeach
                                </div>
                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                                <a href="{{route('role.index')}}" class="btn btn-defult">Back</a>

                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>

@endsection
@push('js')
    <script src="{{Module::asset('role:js/app.js')}}" defer></script>
@endpush
