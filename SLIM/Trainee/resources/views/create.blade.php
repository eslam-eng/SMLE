@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <form class="card" id="createForm">
                            @csrf
                            <div class="card-body">
                                <h3 class="card-title">Add New Trainee</h3>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" placeholder="Full Name">
                                        </div>
                                      </div>
                                    </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">User name</label>
                                            <input type="text" class="form-control" name="user_name" placeholder="User Name">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" class="form-control" name="email" placeholder="E-mail">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label">Code</label>
                                          <select class="form-control" name="phone_code">
                                              @foreach(\DB::table('country')->get() as $country)
                                                  <option value="{{$country->phonecode}}">{{$country->iso3}}
                                                      ({{$country->phonecode}})</option>
                                              @endforeach
                                          </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label">Phone</label>

                                            <input type="phone" class="form-control" name="phone" placeholder="Phone">
                                        </div>
                                    </div>

                                </div>

                                <div class="row row-cards">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" id="passwordField" placeholder="password" aria-label="Input group example" aria-describedby="btnGroupAddon">
                                                <div class="input-group-prepend toggle_show_password">
                                                    <div class="input-group-text" id="toggle_show_password"><i class="fa fa-eye" style="cursor: pointer"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Educational Degree</label>
                                            <select class="form-control" name="degree">
                                                <option disabled="disabled" selected>select Degree</option>
                                                <option value="Student">Student</option>
                                                <option value="Bachelor">Bachelor</option>
                                                <option value="Master">Master</option>
                                                <option value="Doctorate">Doctorate</option>
                                            </select>

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
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                                <a href="{{route('trainee.index')}}" class="btn btn-defult">Back</a>

                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>

@endsection
@push('js')
    <script src="{{Module::asset('trainee:js/app.js')}}" defer></script>
@endpush
