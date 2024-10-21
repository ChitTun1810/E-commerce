<div>
    <div>
        <style>
            .later-table {
                border: 1px solid #ccc;
                border-collapse: collapse;
                margin: 0;
                padding: 0;
                width: 100%;
                table-layout: fixed;
                display: none;
                }
            .early-table{
                display: none;
            }

    
                .later-table caption {
                font-size: 1.5em;
                margin: .5em 0 .75em;
                }
    
                .later-table tr {
                background-color: #f8f8f8;
                border: 1px solid #ddd;
                padding: .35em;
                }
    
                .later-table th,
                .later-table td {
                padding: .625em;
                text-align: center;
                }
    
                .later-table th {
                font-size: .85em;
                letter-spacing: .1em;
                text-transform: uppercase;
                }
    
                @media screen and (max-width: 600px) {
                .later-table {
                    border: 0;
                }
    
                .later-table caption {
                    font-size: 1.3em;
                }
                
                .later-table thead {
                    border: none;
                    clip: rect(0 0 0 0);
                    height: 1px;
                    margin: -1px;
                    overflow: hidden;
                    padding: 0;
                    position: absolute;
                    width: 1px;
                }
                
                .later-table tr {
                    border-bottom: 3px solid #ddd;
                    display: block;
                    margin-bottom: .625em;
                }
                
                .later-table td {
                    border-bottom: 1px solid #ddd;
                    display: block;
                    font-size: .8em;
                    text-align: right;
                }
                
                .later-table td::before {
                    /*
                    * aria-label has no advantage, it won't be read inside a table
                    content: attr(aria-label);
                    */
                    content: attr(data-label);
                    float: left;
                    font-weight: bold;
                    text-transform: uppercase;
                }
                
                .later-table td:last-child {
                    border-bottom: 0;
                }
                }
                /* general styling */
                body {
                font-family: "Open Sans", sans-serif;
                line-height: 1.25;
                }
        </style>
        @if(session('message'))
            <div class="alert alert-info">
                {{session('message')}}
            </div>
        @endif
        <table class="later-table">
            <thead >
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Total</th>
                <th scope="col">Discount</th>
                <th scope="col">Products</th>
                <th scope="col">Cancel Order</th>
          </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @if(auth()->user()->name == $order->user_name)
                        <tr>
                            <td data-label="Name">{{$order->user_name}}</td>
                            <td data-label="Total">{{(int)$order->total}} </td>
                            <td data-label="Discount">{{(int)$order->discount}} $</td>
                            <td data-label="Products">
                                <table> 
                                    <thead>
                                    <tr>
                                        <th scope="col"><small>Product Name</small> </th>
                                        <th scope="col"><small>Price</small> </th>
                                        <th scope="col"><small>Quantity</small> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderitems as $orderitem)
                                            @if($orderitem->order_id == $order->id) 
                                                <tr>
                                                    <td data-label="Product Name">{{$orderitem->productname}}</td>
                                                    <td data-label="Price">$ {{(int)$orderitem->price}}</td>
                                                    <td data-label="Quantity">{{$orderitem->quantity}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                </table>
                            </td>
                            <td data-label="Cancel Order">
                                <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="cancleOrder({{$order->id}})">Cancle Order</a>
                            </td>
        
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    
        <table class="table early-table"> 
            <tr>
                <th>Name</th>
                <th>Total</th>
                <th>Discount</th>
                <th>Products</th>
                <th>Cancle Order</th>
            </tr>
            @foreach($orders as $order)
                    <tr>
                        <td>{{$order->user_name}}</td>
                        <td>{{$order->total}} $</td>
                        <td>{{(int)$order->discount}} $</td>
                        <td>
                            <table class="table table-striped">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                </tr>
                                @foreach($orderitems as $orderitem)
                                    @if($orderitem->order_id == $order->id)
                                        <tr>
                                            <td>{{$orderitem->productname}}</td>
                                            <td>{{$orderitem->price}}</td>
                                            <td>{{$orderitem->quantity}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm" wire:click.prevent="cancleOrder({{$order->id}})">Cancle Order</a>
                        </td>
                    </tr>
            @endforeach
        </table>
    
        @livewire('footer-component')
    </div>
    @push('scripts')
        <script>
            $(document).ready(function(){
                function handleScreenSize() {
                    var width = $(window).width();

                    if (width >= 580) {
                    $('.early-table').show();
                    $('.later-table').hide();
                    } else {
                    $('.early-table').hide();
                    $('.later-table').show();
                    }
                }
                    // Initial setup
                handleScreenSize();

                // Bind the function to the window resize event
                $(window).resize(function() {
                handleScreenSize();
                });
            });
        </script>
    @endpush