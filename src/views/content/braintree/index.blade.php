<form action="{{ route('braintree.pay') }}" method="post">
    @csrf
    <x-gateway::braintree_pay />
    <input type="submit" value="Pay"/>
</form>
