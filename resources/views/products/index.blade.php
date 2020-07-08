@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('home') }}" class="mr-2"><i class="fa fa-arrow-left"></i></a>
                            Products List
                        </div>
                        <div>
                            <a href="{{ route('products.create') }}" class="btn btn-sm btn-light shadow-sm"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-5 form-group">
                            <label for="q" class="col-md-6 col-form-label text-md-right">Search</label>
                        <div class="col-md-6">
                            <form action="" method="get">
                                <input type="text" name="q" id="q" class="form-control shadow-sm" value="{{ request('q') }}">
                            </form>
                        </div>
                    </div>

                    <table class="table table-borderless">
                        <thead class="text-center">
                            <th>No</th>
                            <th style="min-width: 100px;">Photo</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($products as $a => $product)
                               <tr>
                                   <td class="text-center align-middle">{{ $products->firstItem() + $a }}</td>
                                   <td class="text-center align-middle">
                                        <img src="{{ $product->image }}" alt="" class="img-thumbnail" width="100">
                                    </td>
                                   <td class="align-middle">{{ $product->name }}</td>
                                   <td class="align-middle text-center">
                                       <span class="badge badge-primary" data-toggle="popover" data-placement="top" data-content="{{ $product->category->category }}" data-trigger="hover">
                                           {{ str_limit($product->category->category, 20) }}
                                        </span>
                                    </td>
                                   <td class="align-middle">@currency($product->price)</td>
                                   <td class="align-middle text-center">
                                       <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                   </td>
                                </tr> 
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="pagination justify-content-center">
                        {!! $products->appends(['q' => request('q')])->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection