<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/css/style.default.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/custom.css') }}">
    <style>
        /* Add_product Button */



/* CSS */
.button-33 {
  background-color: #c2fbd7;
  border-radius: 100px;
  box-shadow: rgba(44, 187, 99, .2) 0 -25px 18px -14px inset,rgba(44, 187, 99, .15) 0 1px 2px,rgba(44, 187, 99, .15) 0 2px 4px,rgba(44, 187, 99, .15) 0 4px 8px,rgba(44, 187, 99, .15) 0 8px 16px,rgba(44, 187, 99, .15) 0 16px 32px;
  color: green;
  cursor: pointer;
  display: inline-block;
  font-family: CerebriSans-Regular,-apple-system,system-ui,Roboto,sans-serif;
  padding: 7px 20px;
  text-align: center;
  text-decoration: none;
  transition: all 250ms;
  border: 0;
  font-size: 16px;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-33:hover {
  box-shadow: rgba(44,187,99,.35) 0 -25px 18px -14px inset,rgba(44,187,99,.25) 0 1px 2px,rgba(44,187,99,.25) 0 2px 4px,rgba(44,187,99,.25) 0 4px 8px,rgba(44,187,99,.25) 0 8px 16px,rgba(44,187,99,.25) 0 16px 32px;
  transform: scale(1.05) rotate(-1deg);
}

      .heading-div{
        background-color: #01204E;
        color:#028391;
        padding:20px;
        text-align: center;
        width: 98%;
        display: flex;
        margin-left: 10px;
        column-gap: 400px;
      }
        .p-heading{

            color:#028391;



        }
        .product_table {
            width: 98%;
            margin: auto;
            /* margin-top: 50px; */
            border-collapse: collapse;
            background-color: #000;
            color: #fff;
            border: 1px solid #aca7a7;
        }

        .product_table th, .product_table td {
            border: 1px solid #aca7a7;
            padding:10px 5px;
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

        .button-edit, .button-delete {
            appearance: button;
            border: 1px solid #fff;
            border-radius: 4px;
            box-shadow: #fff 4px 4px 0 0, #000 4px 4px 0 1px;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: ITCAvantGardeStd-Bk, Arial, sans-serif;
            font-size: 15px;
            font-weight: 400;
            line-height: 12px;
            text-align: center;
            text-transform: none;
            touch-action: manipulation;
            user-select: none;
            vertical-align: middle;
            white-space: nowrap;
            padding: 8px 20px;
            margin-right: 3px;
        }

        .button-edit {
            background-color: #020202;
        }

        .button-edit:hover {
            background-color: #0c0c0c;
            color: #00f100;
            text-decoration: none;
        }

        .button-delete {
            background-color: #dc3545;
        }

        .button-delete:hover {
            background-color: #c82333;
            color: #000000;
            text-decoration: none;
        }

        .button-edit:focus, .button-delete:focus {
            text-decoration: none;
        }

        .button-edit:active, .button-delete:active {
            box-shadow: rgba(0, 0, 0, .125) 0 3px 5px inset;
            outline: 0;
        }

        .button-edit:not([disabled]):active, .button-delete:not([disabled]):active {
            box-shadow: #fff 2px 2px 0 0, #000 2px 2px 0 1px;
            transform: translate(2px, 2px);
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="container-fluid table-container">
            <div class="heading-div">
                <h2 class="p-heading">Product Management  </h2>
                <form action="{{url('product_search')}}" method="get">
                    @csrf
                    <input placeholder="Search Product" style="padding:2px 5px;border: 1px solid #fff;border-radius: 3px" type="search" name="search">
                    <input type="submit" class="button-edit" value="search">
                </form>
            </div>

            <table class="table table-striped product_table">
                <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Product Title</th>
                        <th>Product Description</th>
                        <th>Product Image</th>
                        <th>Product Price</th>
                        <th>Product Category</th>
                        <th>Product Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            <td style="width: 10px;">{{ $index + 1 }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{!!Str::limit($product->description,30) !!}</td>
                            <td style="width: 10px;"><img src="{{ asset('products/'.$product->image) }}" alt="Product Image" width="50"></td>
                            <td style="width: 10px;">{{ $product->price}}</td>
                            <td style="width: 10px;">{{ $product->category }}</td>
                            <td style="width: 10px;">{{ $product->quantity }}</td>
                            <td>
                                <a href="{{ url('edit_product', $product->id) }}" class="button-edit">Edit</a>
                                <a href="{{ url('delete_product', $product->id) }}" class="button-delete" onclick="confirmation(event)">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div style="margin-top: 20px;display: flex;align-items: center;justify-content: center;">
            {{$products->onEachSide(1)->links()}}
        </div>

    </div>

    <!-- JavaScript files -->

    <!-- SweetAlert CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');

            swal({
                    title: "Are you sure to Delete the Item?",
                    text: "This delete will remove the item permanently",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>

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
