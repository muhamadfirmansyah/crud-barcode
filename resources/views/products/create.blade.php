@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url()->previous() }}" class="mr-2"><i class="fa fa-arrow-left"></i></a>
                    Add Product
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger" role="alert">
                            There are somethings error :
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 text-center w-100">
                                <img src="https://dummyimage.com/300.png/09f/fff" alt="" id="image-preview" class="img-thumbnail w-100">
                                <input type="file" name="image" id="image" class="d-none">
                                <label for="image" class="btn btn-md mt-2 btn-light shadow-sm d-block"><i class="fa fa-upload"></i></label>
                            </div>
                            <div class="col-md-9">
                                <div class="container">
                                    <div class="row form-group">
                                        <label class="font-weight-bold col-md-3 col-form-label">Product Name</label>
                                        <input type="text" name="name" id="name" class="form-control col-md-9" value="{{ old('name') }}">
                                    </div>
                                    <div class="row form-group">
                                        <label class="font-weight-bold col-md-3">Description</label>
                                        <textarea name="description" id="description" cols="" rows="" class="form-control col-md-9">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="row form-group">
                                        <label class="font-weight-bold col-md-3 col-form-label">Category</label>
                                        <select name="category" id="category" class="custom-select col-md-9">
                                            <option value=""></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row form-group">
                                        <label class="font-weight-bold col-md-3 col-form-label">Price</label>
                                        <input type="number" name="price" id="price" class="form-control col-md-9" value="{{ old('price') }}">
                                    </div>
                                    <div class="row form-group">
                                        <label class="font-weight-bold col-md-3 col-form-label">Barcode</label>
                                        <input type="text" name="barcode" id="barcode" class="form-control col-md-9" value="{{ old('barcode') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-md btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')

@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        function readURL(input) {
            var reader = new FileReader();
            reader.onload = function(e){
                $('#image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }

        $('#image').on('change', function(){
            readURL(this);
        });
    });
</script>
@endsection