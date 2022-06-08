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
            <form method="post" action="{{route('addexpense')}}">
                @csrf
                <div class="row" id="cardstyle">
                    <div class="card" style="width:100%">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <h3>Add Expenses</h3>    
                        </div>
                        @if (Session::has('errMsg'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{Session::get('errMsg')}}</li>
                                </ul>
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6 col-sm-12 col-lg-6 rowspacing">
                                @isset($expensetypes)
                                    <select name="personid" class="form-control" required>
                                    <option value="">---Select Member---</option>
                                    @foreach($members as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                    </select>
                                @endisset
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6 rowspacing">
                                @isset($expensetypes)
                                    <select name="exptype" class="form-control" id="exptype" required>
                                    <option value="">---Select Share Type---</option>
                                    @foreach($expensetypes as $row)
                                        <option value="{{$row->id}}">{{$row->expensetype}}</option>
                                    @endforeach
                                    </select>
                                @endisset
                            </div>
                            <div class="col-md-8 col-sm-12 col-lg-8 rowspacing">
                                <h3>Share Among</h3>
                                @isset($members)
                                    @foreach($members as $row)
                                        <div class="row" style="margin-bottom : 10px;">
                                            <div class="col-md-5 col-lg-5 col-sm-12">
                                                <input type="checkbox" name="sharewith[]" value="{{$row->id}}" 
                                                checked="checked" id="{{$row->id}}" data-id="{{$row->id}}" 
                                                class="chkvalue"/>
                                                <p id="name{{$row->id}}">{{$row->name}}</p>
                                            </div>
                                            <div class="col-md-7 col-lg-7 col-sm-12">
                                                <input type="number" name="sharevalue[]" value="0" id="val{{$row->id}}"
                                                class="form-control sharevalue" 
                                                placeholder="Exact/Percent Share (0 in case of EQUAL share)" 
                                                data-id="val{{$row->id}}" required/>
                                            </div>
                                        </div>
                                    @endforeach
                                 @endisset    
                            </div>
                            <div class="col-md-4 col-sm-12 col-lg-4 rowspacing">
                                <input type="number" name="amount" class="form-control" placeholder="Amount" required/>    
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 rowspacing">
                                <input type="submit" name="submit" class="btn btn-success" value="Add & Share Expense"/>
                            </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>
        </div>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.chkvalue').on('click', function() {
                let id = $(this).data("id");
                let valueid = $('#val'+id).data("id");
                let nameid = $('#name'+id).data("id");
                let isChecked = $('#'+id)[0].checked;
                if(isChecked) {
                    $('#val'+id).show();
                }
                else {
                    $('#'+id).remove();
                    $('#val'+id).remove();
                    $('#name'+id).remove();
                }
            });
        });
    </script>
</html>