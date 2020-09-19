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
    <!-- message-->
    @if(session('alert'))
        <div class="container">
            <div class="alert alert-danger col-12  text-center alert-dismissable" style="border-radius: unset; margin: 10px 0;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>Danger !! </b>
                {{ Session::get('alert') }}
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
                <div class="card-header"><b>Applicant Dashboard</b></div>

                <div class="card-body">


                    <form method="POST" action="{{ route('applicant.update', $applicant->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $applicant->first_name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $applicant->last_name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $applicant->email }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Profile Images</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="image" accept="image*" onchange="readURL(this)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Image View</label>

                            <div class="col-md-6">
                                <img src="{{ asset('assets/images/'.$applicant->image) }}" alt="" width="50px" height="50px" id="image">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="resume" class="col-md-4 col-form-label text-md-right">Upload Resume</label>

                            <div class="col-md-6">
                                <input type="file" id="resume"  class="form-control" name="resume" value="{{ old('resume') }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="skill" class="col-md-4 col-form-label text-md-right">Skills</label>

                            <div class="col-md-6">
                                <textarea id="skill" type="text" class="form-control" name="skill" >{{ $applicant->skill ? $applicant->skill : old('skill') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Update</button>
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
