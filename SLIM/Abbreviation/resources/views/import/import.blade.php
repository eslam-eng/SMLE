@extends('admin::layouts.index')
@section('content')
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <div class="col-12">
                        <a href="{{route('abbreviation.download-template')}}" role="button" class="btn btn-info ms-2"><i class="fa fa-download"></i>download Empty Template</a>
                        <form method="post" action="{{route('abbreviation.import')}}" class="card">
                            <div class="card-body">
                                <h3 class="card-title">import Abbreviation</h3>
                                <div class="row row-cards">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">excel file</label>
                                            <input type="file" class="form-control" accept=".xlsx,.xls" id="chars">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="text-end p-1">
                                <button type="submit" class="btn btn-success" id="searchBtn">import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

