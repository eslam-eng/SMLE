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
                        <form class="card" id="updateForm" action="{{route('setting.update',1)}}">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="card-body">
                                <h3 class="card-title"></h3>
                                <div class="row row-cards">


                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">App Name</label>
                                            <input type="text" class="form-control" name="app_name" placeholder="App Name" value="{{$setting->app_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$setting->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Whatsapp</label>
                                            <input type="text" class="form-control" name="whatsapp" placeholder="Whatsapp" value="{{$setting->whatsapp}}">
                                        </div>
                                    </div>


                                </div>



                                <div class="row row-cards">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Logo</label>
                                            <input type="file" class="form-control" name="web_logo" placeholder="Logo">
                                            <img src="{{asset($setting->logo)}}" style="height:100px;width:100px;margin-top:10px">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Website Icon</label>
                                            <input type="file" class="form-control" name="web_icon" placeholder="Website Icon">
                                             <img src="{{asset($setting->website_icon)}}" style="height:100px;width:100px;margin-top:10px">
                                         </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">E-mail</label>
                                            <input type="text" class="form-control" name="email" placeholder="E-mail" value="{{$setting->email}}">
                                        </div>
                                    </div>


                                </div>
                                <div class="row row-cards">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">FaceBook</label>
                                            <input type="text" class="form-control" name="facebook" placeholder="FaceBook" value="{{$setting->facebook}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Youtube</label>
                                            <input type="text" class="form-control" name="youtube" placeholder="Youtube" value="{{$setting->youtube}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Linked In</label>
                                            <input type="text" class="form-control" name="linked_in" placeholder="Linked In" value="{{$setting->linked_in}}">
                                        </div>
                                    </div>


                                </div>

                                <div class="row row-cards">

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">URL App(Play Store)</label>
                                            <input type="text" class="form-control" name="url_play_store" placeholder="URL App(Play Store)" value="{{$setting->url_play_store}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">URL App(Apple Store)</label>
                                            <input type="text" class="form-control" name="url_apple_store" placeholder="URL App(Apple Store)" value="{{$setting->url_apple_store}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="row row-cards">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">About App</label>
                                            <textarea  class="form-control" name="about_app">{{$setting->about_app}}</textarea>
                                        </div>
                                    </div>



                                </div>


                                Quiz Setting
                                <hr>

                                <div class="row row-cards">

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <input type="hidden" value="0" name="is_difficult">
                                            <input type="checkbox" value="1" name="is_difficult" {{$setting->is_difficult ? 'checked':''}}>
                                            <label >Quiz Difficulty Levels</label>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <input type="hidden" value="0" name="timer">
                                            <input type="checkbox" value="1" name="timer" {{$setting->timer ? 'checked':''}}>
                                            <label>Quiz Timer</label>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <input type="hidden" value="0" name="question_timer">
                                            <input type="checkbox" value="1" name="question_timer" {{$setting->question_timer ? 'checked':''}}>
                                            <label>Question Timer</label>

                                        </div>
                                    </div>



                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <input type="hidden" value="0" name="automatic_correct">
                                            <input type="checkbox" value="1" name="automatic_correct" {{$setting->automatic_correct ? 'checked':''}}>
                                            <label>Answers Auto Correction</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <input type="hidden" value="0" name="try_answer">
                                            <input type="checkbox" value="1" name="try_answer" {{$setting->try_answer ? 'checked':''}}>
                                            <label>Attempts To Answers</label>
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>

@endsection
@push('js')
    <script src="{{Module::asset('setting:js/app.js')}}" defer></script>
@endpush
