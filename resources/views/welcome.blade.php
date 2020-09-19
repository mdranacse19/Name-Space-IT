<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Name Space IT</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="top-right">

                <a class="btn btn-primary" target="_blank" href="{{ url('login/company/show') }}"> Company</a>
                <a class="btn btn-primary"  target="_blank" href="{{ url('login/applicant/show') }}">Applicant</a>


            </div>

            <div class="container" >

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



                <div class="card-body">
                    <h4><b>Applicant List</b></h4>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Company Name</th>
                                <th>Salary</th>
                                <th>Location</th>
                                <th>Job Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($post as $list)
                            <tr>
                                <td> {{ $list->job_title }} </td>
                                <td> {{ $list->company->business_name }} </td>
                                <td> {{ $list->salary }} </td>
                                <td> {{ $list->location.' '.$list->country }} </td>
                                <td> {{ $list->job_description }} </td>
                                <td>
                                    <a href="{{ route('apply.job', $list->id) }}" class="btn btn-primary">Apply</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>



        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>


    </body>
</html>
