<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Expense Monitoring Application</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="{{ URL::asset('css/styles.css'); }} " rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form method="post" action="{{route('addmember')}}">
            @csrf
                <div class="row" id="cardstyle">
                    <div class="card" style="width:100%">
                        <div class="col-md-12 col-sm-12 col-lg-6">
                            <h3>Register a new Member</h3>    
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 col-sm-12 col-lg-6 rowspacing">
                                <input type="text" name="membername" class="form-control" 
                                placeholder="Member name" required />
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6 rowspacing">
                                <input type="email" name="email" class="form-control" placeholder="Email Id" required />
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6 rowspacing">
                                <input type="number" name="contactno" class="form-control" placeholder="Contact No." 
                                required />
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 rowspacing">
                                <input type="submit" name="submit" class="btn btn-success" value="Add Member"/>
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>