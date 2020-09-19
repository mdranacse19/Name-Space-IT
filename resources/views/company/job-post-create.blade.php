@extends('layouts.app')

@section('content')
<div class="container">

    <!-- message-->
    @if(session('message'))
        <div class="container">
            <div class="alert alert-success col-12  text-center alert-dismissable" style="border-radius: unset; margin: 10px 0;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>Success !! </b>
                {{ Session::get('message') }}
            </div>
        </div>
    @endif

    @if($errors)
        @foreach($errors->all() as $error)
            <div class="container">
                <div class="alert alert-danger col-12  text-center alert-dismissable" style="border-radius: unset; margin: 10px 0;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>Danger !! </b>
                    {{ $error }}
                </div>
            </div>
        @endforeach
    @endif


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>Create Job Post</b></div>

                <div class="card-body">


                    <form method="POST" action="{{ route('company.job-post.store') }}" >
                        @csrf
                        <input type="hidden" name="rowId" value="">


                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">Company Name</label>
                            <input type="hidden" name="company_id" class="form-control" value="{{ $company->id }}">

                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $company->business_name }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="job_title" class="col-md-4 col-form-label text-md-right">Job Title</label>

                            <div class="col-md-6">
                                <input id="job_title" type="text" class="form-control" name="job_title" value="{{ old('job_title') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salary" class="col-md-4 col-form-label text-md-right">Salary</label>

                            <div class="col-md-6">
                                <input id="salary" type="number" class="form-control" name="salary" value="{{ old('salary') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>

                            <div class="col-md-6">
                                <input id="location" type="text" class="form-control" name="location" value="{{ old('location') }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="job_description" class="col-md-4 col-form-label text-md-right">Job Description</label>

                            <div class="col-md-6">
                                <textarea id="job_description" type="text" class="form-control" name="job_description" >{{ old('job_description') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('company.dashboard') }}" class="btn btn-success">Back</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

    <!-- Page script -->
    <script !src="" type="text/javascript">

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(80)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>

@endpush
