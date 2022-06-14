<form action="{{ route('products.search') }}" class="d-flex mr-3">
    <div class="form-group mb-0 mr-1">
        <input type="text" class="form-control" name="q" value="{{ request()->q ?? '' }}">
    </div>
    <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
</form>