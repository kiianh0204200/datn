<div>

    <p>{{ __('frontend.Dear') }} {{ $order->user->name }},</p>
    <p>{{ __('frontend.Your order has been confirmed') }}!</p>
    <p>{{ __('frontend.Order ID') }}: {{ $order->order_id }}</p>
    <p>{{ __('frontend.Order Total') }}: {{ formatPrice($order->total) }} đ</p>
    <p>{{ __('frontend.Order Status') }}: {{ $order->order_status }}</p>
    <p>{{ __('frontend.Order Date') }}: {{ $order->created_at->format('d-m-Y H:i') }}</p>
    <p>{{ __('frontend.Order Items') }}:</p>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>{{ $item->name }} - {{$item->size}} - {{$item->color}} - {{ $item->quantity }} x {{ formatPrice($item->price) }} đ</li>
        @endforeach
    </ul>
    <p>{{ __('frontend.Thank you for shopping with us') }}!</p>
    <p>{{ __('frontend.Regards') }},</p>
    <p>Team {{ config('app.name') }}</p>

</div>
