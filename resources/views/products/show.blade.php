@extends('layouts.master')

@section('content')
  <div class="col-md-12" style="">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <div>
          <div class="badge badge-pill badge-info">{{ $stock }}</div>
        @foreach($product->categories as $category)
        <small style="font-size: 16px" class="d-inline-block mb-2 text-info"  >{{ $category->name }}{{ $loop->last ? '': ', '}}</small>
        @endforeach
        </div>
        
        <h4 class="mb-0" style="font-family: Verdana, Geneva, Tahoma, sans-serif">{{ $product->title }}</h4>
        <div class="mb-1 text-muted">{{ $product->created_at->format( 'd/m/Y' ) }}</div>
        <p class="card-text mb-auto">{{ $product->description }}</p>
        <br>
        <br>
        <p class="mb-auto" style="font-size: 40px;">{{ $product->getPrice() }}</p><br>
        @if($stock == "Disponible")
        <form action="{{ route('cart.store') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
        </form>
        @endif
      </div>
      <div class="col-auto d-none d-lg-block pt-4">
        <img src="{{ $product->image }}" alt="">
      </div>
    </div>
  </div>
@endsection