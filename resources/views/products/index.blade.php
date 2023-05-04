@extends('layouts.app')
@section('content')
<main class="container">
    <section>
        <div class="titlebar">
            <h1>Products</h1>
            <a class="button" href=" {{ route('products.create') }}">Add Product</a>
        </div>
        @if ($message = Session::get('success'))
            <ul>
                <li>
                    {{ $message}}
                </li>
            </ul>
        @endif
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-search">   
                <div>
                    <button class="search-select">
                       Search Product
                    </button>
                    <span class="search-select-arrow">
                        <i class="fas fa-caret-down"></i>
                    </span>
                </div>
                <div class="relative">
                    <input class="search-input" type="text" name="search" placeholder="Search product..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="table-product-head">
                <p>Image</p>
                <p>Name</p>
                <p>Category</p>
                <p>Inventory</p>
                <p>Actions</p>
            </div>
            <div class="table-product-body">
                
                @if (count($products) > 0)
                    @foreach ($products as $product)
                    <img src="{{ asset('images/'.$product->image)}}"/>
                    <p> {{ $product->name }}</p>
                    <p> {{ $product->category }}</p>
                    <p> {{ $product->quantity }}</p>   
                    <div>     
                        <button class="btn btn-success" >
                            <i class="fas fa-pencil-alt" ></i> 
                        </button>
                        <button class="btn btn-danger" >
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>                     
                    @endforeach
                @endif
                
            </div>
            <div class="table-paginate">
                <div class="pagination">
                    <a href="#" disabled>&laquo;</a>
                    <a class="active-page">1</a>
                    <a>2</a>
                    <a>3</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </div>
    </section>
    
    {{-- <section>
        <div class="titlebar">
            <h1>Edit Product</h1>
            <button>Save</button>
        </div>
        <div class="card">
           <div>
                <label>Name</label>
                <input type="text" >
                <label>Description (optional)</label>
                <textarea cols="10" rows="5" ></textarea>
                <label>Add Image</label>
                <img src="1.jpg" alt="" class="img-product" />
                <input type="file" >
            </div>
           <div>
                <label>Category</label>
                <select  name="" id="" >
                    <option value="" >Email Subscription</option>
                </select>
                <hr>
                <label>Inventory</label>
                <input type="text" class="input" >
                <hr>
                <label>Price</label>
                <input type="text" class="input" >
           </div>
        </div>
        <div class="titlebar">
            <h1></h1>
            <button>Save</button>
        </div>
    </section> --}}
    <br>
</main>  
@endsection