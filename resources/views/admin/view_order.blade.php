<head>
    @include('admin.css')

    <style>
        .heading-div {
            background-color: #01204E;
            color: #028391;
            padding: 20px;
            text-align: center;
            width: 98%;
            display: flex;
            margin-left: 10px;
            column-gap: 400px;
        }

        .p-heading {

            color: #028391;
            background-color: black;
            padding: 10px;
            width:98%;
            margin-left: 10px;
            text-align: center;
            font-weight: bolder;

        }

        .product_table {
            width: 100%;
            margin: auto;
            /* margin-top: 50px; */
            border-collapse: collapse;
            background-color: #000;
            color: #fff;
            border: 1px solid #aca7a7;
        }

        .product_table th,
        .product_table td {
            border: 1px solid #aca7a7;
            padding: 10px 5px;
            text-align: center;
            vertical-align: middle;
        }

        .product_table th {
            background-color: #A0937D;
            font-size: 18px;
            color: #1A4D2E;


        }

        .product_table td {
            font-size: 15px;
        }
    </style>
</head>

<body>

    @include('admin.header')

    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <h2 class="p-heading"> ORDER LIST </h2>
            <table class="table table-striped product_table">

                <thead>
                    <tr>

                        <th>Custome Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product List</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th> Change Status</th>
                        <th> Print</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                        <tr>

                            <td>{{ $data->name }}</td>
                            <td>{{ $data->rec_address }}</td>
                            <td>{{ $data->phone }}</td>
                            <td>{{ $data->product->title }}</td>
                            <td>{{ $data->product->price }}</td>
                            <td>
                                <img width="50" src="products/{{ $data->product->image }}" alt="">
                            </td>

                            <td>
                                @if ($data->status == 'in progress')
                                    <span class="badge badge-success">{{$data->status}}</span>
                                @elseif($data->status == 'Delivered')
                                    <span class="badge badge-danger">{{$data->status}}</span>
                                @else
                                    <span class="badge badge-info">{{$data->status}}</span>
                                @endif
                            </td>
                            <td >
                                <a  class="btn btn-info" href="{{url('on_the_way',$data->id )}}">Onway</a>
                                <a class="btn btn-danger" href="{{url('delivered',$data->id)}}">Delivered</a>
                            </td>
                            <td>
                                <a class="btn btn-light" href="{{url('print_pdf',$data->id)}}">Print</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
    </div>

    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>

</html>
