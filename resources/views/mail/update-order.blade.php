<h1>
    Your Order status was changed into {{$order->status}}
</h1>
<p>
    Link to your order :
    <a href="{{route('order.index', true)}}">
        Order {{$order->id}}
    </a>
</p>