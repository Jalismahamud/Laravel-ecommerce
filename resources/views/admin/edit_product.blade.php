<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('admincss/css/style.default.css') }}">
    <link rel="stylesheet" href="{{ asset('admincss/css/custom.css') }}">
    <style>
        .edit-product-main {
            width: 80%;
            margin: auto;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #131842;
        }

        .edit-product-main h1 {
            text-align: center;
            margin-bottom: 15px;
            color: #FFF078;
        }

        .input-text {
            width: 100%;
            padding: 5px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;

        }

        /* button-33 css */
        .button-33 {
            background-color: #c2fbd7;
            border-radius: 5px;
            box-shadow: rgba(44, 187, 99, .2) 0 -25px 18px -14px inset, rgba(44, 187, 99, .15) 0 1px 2px, rgba(44, 187, 99, .15) 0 2px 4px, rgba(44, 187, 99, .15) 0 4px 8px, rgba(44, 187, 99, .15) 0 8px 16px, rgba(44, 187, 99, .15) 0 16px 32px;
            color: green;
            cursor: pointer;
            display: inline-block;
            font-family: CerebriSans-Regular, -apple-system, system-ui, Roboto, sans-serif;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            transition: all 250ms;
            border: 0;
            font-size: 20px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: 100%;
            margin-top: 10px;
        }

        .button-33:hover {
            box-shadow: rgba(44, 187, 99, .35) 0 -25px 18px -14px inset, rgba(44, 187, 99, .25) 0 1px 2px, rgba(44, 187, 99, .25) 0 2px 4px, rgba(44, 187, 99, .25) 0 4px 8px, rgba(44, 187, 99, .25) 0 8px 16px, rgba(44, 187, 99, .25) 0 16px 32px;
            transform: scale(1.01) rotate(-0.1deg);
        }
    </style>
</head>

<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <div class="edit-product-main">
                    <h1>Update Product</h1>

                    <form action="{{ url('update_product', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="title">Product Title</label>
                        <input class="input-text" type="text" name="title" value="{{ $product->title }}">

                        <label for="description">Product Description</label>
                        <textarea class="input-text" name="description">{{ $product->description }}</textarea>

                        <label for="price">Product Price</label>
                        <input class="input-text" type="text" name="price" value="{{ $product->price }}">

                        <label for="category">Product Category</label>
                        {{-- <input class="input-text" type="text" name="category" value="{{ $product->category }}"> --}}
                        <select class="input-text" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_name }}" {{ $category->category_name == $product->category ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="quantity">Product Quantity</label>
                        <input class="input-text" type="text" name="quantity" value="{{ $product->quantity }}">

                        <label for="image">Product Image</label>
                        <input class="input-text" type="file" name="image">
                        @if ($product->image)
                            <img src="{{ asset('products/' . $product->image) }}" alt="Product Image" width="80">
                        @endif
                        <br>
                        <input type="submit" class="button-33" role="button" value="Update Product Information">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files -->
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
