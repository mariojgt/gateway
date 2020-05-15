<style>
    .spinner {
  margin: 100px auto;
  width: 50px;
  height: 40px;
  text-align: center;
  font-size: 10px;
}

.spinner > div {
  background-color: #333;
  height: 100%;
  width: 6px;
  display: inline-block;

  -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
  animation: sk-stretchdelay 1.2s infinite ease-in-out;
}

.spinner .rect2 {
  -webkit-animation-delay: -1.1s;
  animation-delay: -1.1s;
}

.spinner .rect3 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

.spinner .rect4 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}

.spinner .rect5 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}

@-webkit-keyframes sk-stretchdelay {
  0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
  20% { -webkit-transform: scaleY(1.0) }
}

@keyframes sk-stretchdelay {
  0%, 40%, 100% {
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }  20% {
    transform: scaleY(1.0);
    -webkit-transform: scaleY(1.0);
  }
}
</style>

<div class="spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
</div>
<div align="center" >Redirect you to stripe see you soon :)</div>

{!!Form::open(['route' => 'stripe', 'method' => 'post' ,'id' => 'stripePay'])!!}
    {{-- products for the cart --}}
    @foreach ($cart['products'] as $item)
        {!! Form::hidden('line_items.name[]', $item['product']) !!} {{-- product name --}}
        {!! Form::hidden('line_items.description[]', $item['slug']) !!} {{-- item description--}}
        {!! Form::hidden('line_items.images[]', env('IMAGE_URL').$item['image']) !!} {{-- product image --}}
        {!! Form::hidden('line_items.amount[]', encrypt($item['exc_vat'])) !!} {{-- the price of the item you seling to the user --}}
        {!! Form::hidden('line_items.quantity[]', encrypt($item['cart_qty'])) !!} {{-- how many items the user us buying --}}
    @endforeach

    {{-- geting the customer info if is not empty --}}
    @if (!empty($cart['customerInfo']))
        {!! Form::hidden('use_customer', encrypt(true)) !!}
        {!! Form::hidden('customer_email', encrypt($cart['customerInfo']['email'])) !!}
    @endif

    @php
        $postageAmount = round($cart['postage_exc_vat'] * 100);
    @endphp
    {{-- the cart vat --}}
    {!! Form::hidden('postage.name[]', "POSTAGE") !!} {{-- product name --}}
    {!! Form::hidden('postage.description[]', "POSTAGE") !!} {{-- item description--}}
    {!! Form::hidden('postage.amount[]', encrypt($postageAmount)) !!} {{-- the price of the item you seling to the user --}}
    {!! Form::hidden('postage.quantity[]', encrypt(1)) !!} {{-- how many items the user us buying --}}

    @php
        $taxAmount = round($cart['cart_vat'] * 100);
    @endphp
    {{-- the cart vat --}}
    {!! Form::hidden('vat.name[]', "VAT") !!} {{-- product name --}}
    {!! Form::hidden('vat.description[]', "VAT") !!} {{-- item description--}}
    {!! Form::hidden('vat.amount[]', encrypt($taxAmount)) !!} {{-- the price of the item you seling to the user --}}
    {!! Form::hidden('vat.quantity[]', encrypt(1)) !!} {{-- how many items the user us buying --}}
{!! Form::close() !!}


<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById("stripePay").submit();
    });
</script>
