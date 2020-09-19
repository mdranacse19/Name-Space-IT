@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Company Dashboard</b>
                    <a href="{{ route('company.job-post.create') }}" class=" text text-right btn btn-primary">Add Job Post</a>
                </div>

                <div class="card-body">
                    <h4><b>Applicant List</b></h4>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Applicant Name</th>
                                <th>Email</th>
                                <th>Skill</th>
                                <th>Resume</th>
                                <th>Profile Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applicantList as $list)
                                <tr>
                                    <td> {{ $list->job_title }} </td>
                                    <td> {{ $list->first_name. ' '.$list->last_name }} </td>
                                    <td> {{ $list->email }} </td>
                                    <td> {{ $list->skill }} </td>
                                    <td><a href="{{ asset('assets/images/'.$list->resume) }}">{{ $list->resume }}</a> </td>
                                    <td><img src="{{ asset('assets/images/'.$list->image) }}" alt="" height="50px" width="50px"> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
