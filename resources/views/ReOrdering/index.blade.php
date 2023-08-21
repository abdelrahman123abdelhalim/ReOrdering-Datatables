<!DOCTYPE html>
<html>

<head>
    <title>Create Drag and Droppable Datatables</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/font-awesome.min.css')}}" />
</head>

<body>
    <div class="row mt-5">
        <div class="col-md-10 offset-md-1">
            <h3 class="text-center mb-4">Create Drag and Droppable Datatables</h3>
            <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>

                    </tr>
                </thead>
                <tbody id="tablecontents">
                    @foreach($user as $user)
                    <tr class="row1" data-id="{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ ($user->email)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>

        </div>
    </div>
    <script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/datatables.min.js')}}"></script>
    <script type="text/javascript">
    $(function() {
        $("#table").DataTable();
        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url ('sortabledatatable')}}",
                data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response)
                    }
                }
            });
        }
    });
    </script>
</body>

</html>