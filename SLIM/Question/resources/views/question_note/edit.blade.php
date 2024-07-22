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
                        <form class="card" id="updateForm" action="{{route('question.update',$question->id)}}">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="card-body">
                                <h3 class="card-title">Update New Question</h3>
                                <div class="row row-cards">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Question</label>
                                            <input type="text" class="form-control" name="question" placeholder="Question Title"
                                              value="{{$question->question}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Model Answer</label>
                                            <input type="text" class="form-control" name="model_answer" placeholder="Model Answer"
                                                   value="{{$question->model_answer}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Question Mark</label>
                                            <input type="number" class="form-control" name="question_mark" placeholder="Question Mark"
                                                   value="{{$question->question_mark}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (A)</label>
                                            <input type="text" class="form-control" name="answer_a" placeholder="Answer (A)"
                                                   value="{{$question->answer_a}}">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (B)</label>
                                            <input type="text" class="form-control" name="answer_b" placeholder="Answer (B)"
                                                   value="{{$question->answer_b}}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (C)</label>
                                            <input type="text" class="form-control" name="answer_c" placeholder="Answer (C)"
                                                   value="{{$question->answer_c}}">

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label">Answer (D)</label>
                                            <input type="text" class="form-control" name="answer_d" placeholder="Answer (D)"
                                                   value="{{$question->answer_d}}">

                                        </div>

                                    </div>




                                </div>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">specialist</label>
                                            <select class="form-control specialization" name="specialist_id">
                                                <option disabled="disabled" selected> select specialist</option>
                                                @foreach($specializations as $specialization)
                                                    <option value="{{$specialization->id}}" {{$specialization->id == $question->specialist_id ?'selected':'' }}>{{$specialization->name}}</option>
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
                                                    <option value="{{$subSpecialization->id}}" {{$subSpecialization->id ==$question->sub_specialist_id ?'selected':''}}>{{$subSpecialization->name}}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">status</label>
                                            <select class="form-control" name="is_active">
                                                <option disabled="disabled" selected>select status</option>
                                                <option value="1" {{$question->is_active ?'selected':''}}>Active</option>
                                                <option value="0" {{!$question->is_active ?'selected':''}}>In Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div class="row row-cards">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Question Description (optional)</label>
                                            <textarea class="form-control" name="description">{{$question->description}}</textarea>

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Question Image (options)</label>
                                            <input type="file" name="question_image" class="form-control">
                                        </div>
                                        <img src="{{asset($question->image)}}">
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary" id="btnSubmit">Update</button>
                                <a href="{{route('question.index')}}" class="btn btn-defult">Back</a>

                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>

    </div>

@endsection
@push('js')
    <script src="{{Module::asset('question:js/app.js')}}" defer></script>
@endpush
