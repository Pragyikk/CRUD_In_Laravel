<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="bg-dark text-center text-white py-3">
        <h1 class='h2'>CRUD</h1>
    </div>

    <div class="container">
        <div class='row'>
            <div class='d-flex justify-content-end p-0 mt-3'>
                <a href="{{route('products.index')}}" class="btn btn-dark ">Back</a>
            </div>
                <div class='card p-0 mt-3'>
                    <div class='card-header bg-dark text-white'>
                        <h4 class='h4'>Create Product</h4>
                     </div>
                    <div class='card-body shadow-lg'>
                        <form action="{{route('products.store')}}" method='post' enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for='name' class='form-label'>Name</label>
                                <input  type='text' value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"  id='name' name='name' placeholder='name'>
                                @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for='image' class='form-label'>Image</label>
                                <input type='file' class="form-control @error('image') is-invalid @enderror" id='image' name='image' placeholder='Image'>
                                @error('image')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for='sku' class='form-label @error('sku') is-invalid @enderror'>SKU</label>
                                <input value="{{old('sku')}}" type='text' class='form-control' id='sku' name='sku' placeholder='SKU'>
                                @error('sku')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for='price' class='form-label @error('price') is-invalid @enderror'>Price</label>
                                <input value="{{old('price')}}" type='text' class='form-control' id='price' name='price' placeholder='Price'>
                                @error('price')
                                    <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for='status' class='form-label'>Status</label>
                                <select name='status' id='status' class='form-select'>
                                    <option value='Active'>Active</option>
                                    <option value='Inactive'>Inactive</option>
                                </select>   
                            </div>
                            <button class='btn btn-dark'>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>