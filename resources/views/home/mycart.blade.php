<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @include('home.css')

    <style>


.order-div {
            background-color: #000;
            color: #fff;
            padding: 20px;
            width: 93.5%;
            margin: auto;
            border-radius: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .order-div form {
            display: flex;
            flex-direction: column;
            width: 50%;
            margin: auto;
        }
        .order-heading{
            font-size: 30px;
            text-align: center;
            font-weight: bolder;
        }

        .div-gap {
            margin-bottom: 15px;
            width: 100%;
        }

        .div-gap label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        .div-gap input[type="text"],
        .div-gap textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #333;
            color: #fff;
        }

        .div-gap textarea {
            resize: vertical;
            height: 80px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* end of the order table css */

        .product_table {
            width: 93.5%;
            margin: auto;
            /* margin-top: 50px; */
            border-collapse: collapse;
            background-color: #000;
            color: #fff;
            border: 1px solid #aca7a7;
            padding-bottom: 20px;

        }

        .product_table th, .product_table td {
            border: 1px solid #aca7a7;
            padding:10px 5px;
            text-align: center;
            vertical-align: middle;


        }

        .product_table th {
            background-color: #dcdcdc;
            font-size: 18px;
            color: #1A4D2E;




        }

        .product_table td {
            font-size: 15px;

        }

        /* button css */
       .button-delete {
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

        .button-delete {
            background-color: #dc3545;
        }

        .button-delete:hover {
            background-color: #c82333;
            color: #000000;
            text-decoration: none;
        }

        .button-delete:focus {
            text-decoration: none;
        }

         .button-delete:active {
            box-shadow: rgba(0, 0, 0, .125) 0 3px 5px inset;
            outline: 0;
        }

        .button-delete:not([disabled]):active {
            box-shadow: #fff 2px 2px 0 0, #000 2px 2px 0 1px;
            transform: translate(2px, 2px);
        }

        .total-price{
            text-align: center;
            width: 93.5%;
            background-color:  #e6e3e3;
            font-size: 25px;
            font-weight: bold;
            color: #1A4D2E;
            padding: 10px;
             margin-left: 41px;

        }
        .total-price span{

            color:rgb(236, 32, 17);
        }

    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
    </div>

{{-- showing add to card product list --}}

    <div class="product_table">


        <h1 style="padding: 20px 0px;text-align:center">Selected Product List</h1>
        <table class="table table-striped product_table">
            <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $value = 0 ?>
                @foreach ($cart as $cart)
                    <tr>

                        <td>{{$cart->product->title }}</td>
                        <td style="width: 200px;"><img src="{{ asset('products/'.$cart->product->image) }}"  width="70"></td>
                        <td>{{$cart->product->price }}</td>
                        <td>
                            <a href="{{ url('delete_product', $cart->product->id) }}" class="button-delete" >Remove</a>
                            {{-- onclick="confirmation(event)" --}}
                        </td>

                    </tr>
                    <?php
                    $value = $value + $cart->product->price;

                      ?>
                @endforeach
            </tbody>
        </table>
        <h3 class="total-price">Total Price of the selected Product :<span> {{$value}}</span><i style="padding-left: 5px;font-size: 20px;" class="fa-solid fa-bangladeshi-taka-sign"></i> </h3>
    </div>


    <div class="order-div">
        <h4 class="order-heading">Send Your Order</h4>
        <form action="{{url('confirm_order')}}" method="POST">
            @csrf
          <div class="div-gap">
             <label for="">Reaciver Name</label>
             <input type="text" value="{{Auth::user()->name}}" name="name">
          </div>
          <div class="div-gap">
             <label for="">Reaciver Address</label>
             <textarea name="address">{{Auth::user()->address}}</textarea>
          </div>
          <div class="div-gap">
             <label for="">Reaciver Phone</label>
             <input type="text" value="{{Auth::user()->phone}}" name="phone">
          </div>
          <input class="btn btn-primary" type="submit" value="Place Order">
        </form>
     </div>




    @include('home.info')

{{-- swit alert link --}}
 <!-- SweetAlert CDN -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

 <script type="text/javascript">
     function confirmation(ev) {
         ev.preventDefault();
         var urlToRedirect = ev.currentTarget.getAttribute('href');

         swal({
                 title: "Are you sure to Remove the Item",
                 text: "This action  will remove the product from your Cart",
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

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
