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
                        <form class="card" id="updateForm" action="{{route('trainee.update',$trainee->id)}}">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="card-body">
                                <h3 class="card-title">Update Trainee</h3>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="{{$trainee->full_name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">User name</label>
                                            <input type="text" class="form-control" name="user_name" placeholder="User Name"  value="{{$trainee->user_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="email" class="form-control" name="email" placeholder="E-mail"  value="{{$trainee->email}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label">Code</label>
                                            <select class="form-control" name="phone_code">
                                                @foreach(\DB::table('country')->get() as $country)
                                                <option value="{{$country->phonecode}}" {{$country->phonecode == $trainee->phone_code ? 'selected':''}}>{{$country->iso3}}
                                                    ({{$country->phonecode}})</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-2">
                                            <label class="form-label">Phone</label>
                                            <input type="phone" class="form-control" name="phone" placeholder="Phone"  value="{{$trainee->phone}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Educational Degree</label>
                                            <select class="form-control" name="degree">
                                                <option disabled="disabled" selected>select Degree</option>
                                                <option value="Student"  {{$trainee->degree =='Student' ?'selected':''}}>Student</option>
                                                <option value="Bachelor" {{$trainee->degree =='Bachelor'  ?'selected':''}}>Bachelor</option>
                                                <option value="Master" {{$trainee->degree =='Master'  ?'selected':''}}>Master</option>
                                                <option value="Doctorate" {{$trainee->degree =='Doctorate'  ?'selected':''}}>Doctorate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">status</label>
                                            <select class="form-control" name="is_active">
                                                <option disabled="disabled" selected>select status</option>
                                                <option value="1" {{$trainee->is_active  ?'selected':''}}>Active</option>
                                                <option value="0" {{!$trainee->is_active  ?'selected':''}}>In Active</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialist</label>
                                            <select class="form-control" name="specialist_id">
                                                <option disabled="disabled" selected> select specialist</option>
                                                @foreach($specializations as $specialization)
                                                    <option value="{{$specialization->id}}" {{$specialization->id == $trainee->specialist_id?'selected':'' }}>{{$specialization->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">sub specialist</label>
                                            <select class="form-control sub-specialization" name="sub_specialist_id">
                                                <option disabled="disabled" selected> select sub specialist</option>
                                                @foreach($subSpecializations as $subSpecialization)
                                                    <option value="{{$subSpecialization->id}}" {{$subSpecialization->id == $trainee->sub_specialist_id ?'selected':''}}>{{$subSpecialization->name}}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                </div>




                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
                                <a href="{{route('trainee.index')}}" class="btn btn-default">Back</a>

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
