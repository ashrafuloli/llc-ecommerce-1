@extends('frontend.layouts.master')

@section('main')
    <div class="container">
        <br>
        <p class="text-center">Cart</p>
        <hr>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="alert alert-info" v-if="cart.length === 0">
            Please add some products to your cart.
        </div>

        <table class="table table-bordered" v-else>
            <thead>
            <tr>
                <td>Serial</td>
                <td>Product</td>
                <td>Unit Price</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product,id in cart">
                <td>@{{ id }}</td>
                <td>@{{ product.title }}</td>
                <td>BDT @{{ product.unit_price }}</td>
                <td>@{{ product.quantity }}</td>
                <td>BDT @{{ product.total_price }}</td>
                <td>
                    <form>
                        <button type="submit" @click.prevent="removeFromCart(id)" class="btn btn-lg btn-outline-secondary">
                            Remove
                        </button>
                    </form>
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td>BDT @{{ total }}</td>
                <td></td>
            </tr>
            </tbody>
        </table>

        <a @click.prevent="clearCart()" class="btn btn-danger">Clear Cart</a>
        <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>

    </div>
@stop
