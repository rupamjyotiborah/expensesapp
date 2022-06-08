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
            <form method="post" action="{{route('getexpenses')}}">
                @csrf
                <div class="row" id="cardstyle">
                    <div class="card" style="width:100%">
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <h3>Expenses and Shares</h3>    
                        </div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-6 col-sm-12 col-lg-6 rowspacing">
                                @isset($members)
                                    <select name="memberid" class="form-control" required>
                                    <option value="">---Select Member---</option>
                                    @foreach($members as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endforeach
                                    </select>
                                @endisset
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6 rowspacing">
                                <input type="submit" name="submit" class="btn btn-success" value="Show Expense"/>
                            </div>
                            <div class="col-md-5 col-sm-12 col-lg-5 rowspacing">
                                @isset($totalexpenses)
                                    <h4 style="text-align:center"><b>Expenses</b></h4>
                                    <table class="table table-bordered">
                                    <tr>
                                        <td><b>Date</b></td>  
                                        <td><b>Amount</b></td>  
                                    </tr>
                                    @foreach($totalexpenses as $row)
                                        <tr>
                                            <td>{{date('d-m-Y', strtotime($row->created_at))}}</td>  
                                            <td>{{$row->amount}}</td>  
                                        </tr>
                                    @endforeach 
                                    </table>   
                                @endisset
                            </div>
                            <div class="col-md-7 col-sm-12 col-lg-7 rowspacing">
                                @isset($totalBalances)
                                    <h4 style="text-align:center"><b>Balances</b></h4>
                                    <table class="table table-bordered">
                                    <tr>
                                        <td><b>Date</b></td>  
                                        <td><b>Amount</b></td>  
                                        <td><b>To be paid to</b></td>
                                    </tr>
                                    @foreach($totalBalances as $row)
                                        <tr>
                                            <td>{{date('d-m-Y', strtotime($row->created_at))}}</td>  
                                            <td>{{$row->amount}}</td>
                                            <td>{{$row->expensemembername}}</td>  
                                        </tr>
                                    @endforeach 
                                    </table>   
                                @endisset
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