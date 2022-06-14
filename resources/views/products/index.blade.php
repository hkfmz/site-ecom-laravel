@extends('layouts.master')

@section('content')
  @foreach($products as $product)
  <div class="col-md-6">
  <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
      <small class="d-inline-block mb-2 text-primary">
        @foreach($product->categories as $category)
            {{ $category->name }}{{ $loop->last ? '': ', '}}
        @endforeach
      </small>
      <h5 class="mb-0" style="font-family: Verdana, Geneva, Tahoma, sans-serif">{{ $product->title }}</h5>
      <p class="card-text mb-auto">{{ $product->subtitle }}</p>
      <p class="mb-auto text-muted font-monospace" style="font-size: 40px;">{{ $product->getPrice() }}</p>
      <a href="{{ route('products.show', $product->slug) }}" class="stretched-link btn btn-info"><i class="fa fa-paper-plane"></i> Consulter le produit</a>
    </div>
    <div class="col-auto d-none d-lg-block">
      <img src="{{ $product->image }}" alt="">
    </div>
  </div>
  </div>
  @endforeach
    {{ $products->appends(request()->input())->links()}}
@endsection