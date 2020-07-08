@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <a href="{{ url()->previous() }}" class="mr-2"><i class="fa fa-arrow-left"></i></a>
                            {{ title_case($product->name) }}
                        </div>
                        <div>
                            <button class="btn btn-sm btn-outline-success shadow-sm"><i class="fa fa-edit"></i></button>
                            <form action="{{ route('products.destroy', $product->id ) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button  type="submit" class="btn btn-sm btn-outline-danger shadow-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ URL::to($product->image) }}" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <label class="font-weight-bold col-md-3 col-form-label">Product Name</label>
                                <p class="col-md-9 col-form-label">{{ $product->name }}</p>
                            </div>
                            <div class="row">
                                <label class="font-weight-bold col-md-3 col-form-label">Description</label>
                                <p class="col-md-9 col-form-label">{{ $product->description }}</p>
                            </div>
                            <div class="row">
                                <label class="font-weight-bold col-md-3 col-form-label">Category</label>
                                <p class="col-md-9 col-form-label">{{ $product->category->category }}</p>
                            </div>
                            <div class="row">
                                <label class="font-weight-bold col-md-3 col-form-label">Price</label>
                                <p class="col-md-9 col-form-label">@currency($product->price)</p>
                            </div>
                            <div class="row">
                                <label class="font-weight-bold col-md-3 col-form-label">Barcode</label>
                                <div class="col-md-9 col-form-label">
                                    <img src="data:image/png;base64,{{DNS1D::getBarcodePNG( $product->barcode , "C39", 1,30) }}" alt="barcode"   />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <div class="row">
                                <div class="col-md-3 offset-md-9">
                                    Scan this QR Code : 
                                    <div class="text-center py-3 bg-light mt-2">
                                        {!! QrCode::size(100)->generate($product->barcode) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection