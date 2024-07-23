@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card-header m-2">
                            <h3 class="card-title">import Abbreviation</h3>
                            <a href="{{route('abbreviation.download-template')}}" role="button" class="btn btn-info ms-2"><i class="fa fa-download"></i>download Empty Template</a>
                        </div>
                        <form method="post" action="{{route('abbreviation.import')}}" class="card" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">excel file</label>
                                            <input type="file" name="file" class="form-control" id="file" required>
                                        </div>
                                        @error('file')
                                           <span class="text-danger"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="text-end p-1">
                                <button type="submit" class="btn btn-success" id="searchBtn">import</button>
                            </div>
                        </form>

                        @if(session('failures'))
                            <div class="alert alert-danger mt-2">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td>row</td>
                                        <td>attribute</td>
                                        <td>error</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(session('failures') as $failure)
                                        <tr>
                                            <td>{{$failure->row()}}</td>
                                            <td>{{$failure->attribute()}}</td>
                                            <td>{{\Illuminate\Support\Arr::first($failure->errors())}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

