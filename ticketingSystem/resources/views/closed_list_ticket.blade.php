<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-2.2.4.js"
            integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
            crossorigin="anonymous">            
    </script>

</head>
<body>
<div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
{{--             <div class="container"> --}}

{{--                 <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <button type="button" class="btn navbar-brand-1" id="show_logs">Logs</button>

                <button type="button" class="btn navbar-brand-1" onclick="window.location='{{ url("/admin") }}'">Open Ticket</button>
                <button type="button" class="btn navbar-brand-1" onclick="window.location='{{ url("/admin/inprogress_ticket") }}'">Inprogress</button>
                <button type="button" class="btn navbar-brand-1" onclick="window.location='{{ url("/admin/closed_ticket") }}'">Closed Ticket</button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
{{--             </div> --}}
        </nav>
</div>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Created by</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Importance</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($closed_tickets as $closed_ticket)
                    <tr>
                        <td>{{ $closed_ticket->ticket_number }}</td>
                        <td>{{ $closed_ticket->name }}</td>
                        <td>{{ $closed_ticket->title }}</td>
                        <td>{{ $closed_ticket->description }}</td>
                        <td>{{ $closed_ticket->importance }}</td>
                        <td>{{ $closed_ticket->date }}</td>
                        <td>{{ $closed_ticket->status }}</td>
                        <td>
                            <a href="#" class="btn btn-primary view-btn">Reopen</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-1">
        </div>
    </div>
</div>
</body>
</html>



<!------------------------------------MODAL------------------------------------>

<div class="modal fade" id="viewModaliclosed" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

                <div class="form-group grp1">
                    <label>Ticket ID:</label>
                    <input type="text" class="form-control" id="ticket_number-1" name='Ticket_number' disabled>
                </div>

                <div class="form-group">
                    <label for="pwd">Name:</label>
                    <input type="text" class="form-control" id="name-1" name='title1' disabled>
                </div>

                <div class="form-group">
                    <label for="pwd">Title:</label>
                    <input type="text" class="form-control" id="title-1" name='title1' disabled>
                </div>

                <div class="form-group">
                    <label for="comment">Description:</label>
                    <textarea class="form-control" rows="3" id="description-1" name='description1' disabled></textarea>
                </div>

                <div class="form-group grp1">
                    <label for="exampleFormControlSelect1">Importance:</label>
                    <select class="form-control" id="importance-1" name='importance1' disabled>
                        <option>Urgent</option>
                        <option>Low</option>
                        <option>High</option>
                    </select>
                </div>

                <div class="form-group grp1">
                    <label>Date created:</label>
                    <input id="date-1" class="form-control" name="curTime" value="<?php echo date('D-M-Y')." ".gmdate("H:i:s", time()); ?>" size="20" maxlength="20"  disabled Required />
                </div>

                <div class="form-group">
                    <input type="hidden" class="form-control" id="inprogress" name='inprogress' value="In progress" disabled >
                    <input type="hidden" class="form-control" id="reopen" name='reopen' value="Open" disabled >
                    <input type="hidden" class="form-control" id="resolved" name='resolved' value="Closed" disabled >
                </div>

                <!--LOGS-->
                    <input id="date_logs" class="form-control" name="curTime" value="<?php echo date('D-M-Y')." ".gmdate("H:i:s", time()); ?>" size="20" maxlength="20"  hidden Required />
                    <input type="hidden" class="form-control" id="reopen_logs" name='inprogress' value="Admin reopen the ticket" disabled >
                <!-------->
        </div>
        <div class="modal-footer">
          <input type = 'submit' class="btn btn-primary" value = "Reopen" id="sbmt-closed-tckt">

        </div>
      </div>
      
    </div>
  </div>

<script>
$(document).ready(function(){

  $('.view-btn').on('click', function(){
    $('#viewModaliclosed').modal('show');

    var tr = $(this).closest('tr');

    var data = tr.children("td").map(function(){
      return $(this).text();
    }).get();

    $('#ticket_number-1').val(data[0]);
    $('#name-1').val(data[1]);
    $('#title-1').val(data[2]);
    $('#description-1').val(data[3]);
    $('#importance-1').val(data[4]);
    $('#date-1').val(data[5]);
  });


$("#sbmt-closed-tckt").click(function(e){
        e.preventDefault();

        var ticket_id = $('#ticket_number-1').val();
        var name = $('#name-1').val();
        var title = $('#title-1').val();
        var description = $('#description-1').val();
        var importance = $('#importance-1').val();
        var date = $('#date-1').val();
        var status = $('#reopen').val();

        var date_logs = $('#date_logs').val();
        var reopen_logs = $('#reopen_logs').val();

        //alert(ticket_id+" "+name+" "+title+" "+description+" "+importance+" "+date+" "+status);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
           type:'POST',
           url:'/admin/closed_to_open',
           data:{
                ticket_id:ticket_id,
                name:name,
                title:title,
                description:description,
                importance:importance,
                date:date,
                status:status,

                date_logs:date_logs,
                reopen_logs:reopen_logs
            },
           success:function(data){
             $('#viewModaliclosed').modal('hide');
             location.reload(true);
           }
        });
    });


});
</script>





<div class="modal fade" id="viewModalLogs" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4>Logs</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="content">
                {{-- empty space --}}
            </tbody>
        </table> 
    </div>
</div>

</div>
</div>

<script>
    $('#show_logs').on('click', function(){
     $('#viewModalLogs').modal('show');
     $.get("/admin/display_logs", function(data){

        var table = '';

        // console.log(data[0].date);

        if(data.length > 0){
            $.each(data, function(index){
                table += ('<tr><td>'+data[index].date+'</td><td>'+data[index].action+'</td></tr>');
            });
        } else {
            $("#content").html('<tr><td colspan="2">0 results</td></tr>');
        }

        $("#content").html(table);
     });

 });
</script>