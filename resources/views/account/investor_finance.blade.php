<link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">


<div class="container">
    @if(Session::has('flash_message'))

    <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {{ session('flash_message') }}

    </div>

    @endif
</div>

<div class="col-md-4 col-md-offset-3">
    <form method="post" action="{{ url('investor/add-finance') }}">
        {!! CSRF_FIELD() !!}
        <div class="form_field {{ $errors->has('financial_amount') ? 'has-error' : ''}}" >
            <label for="financial_amount">Amount</label>
            <input type="text" name="financial_amount" value="{{ old('financial_amount') }}" class="form-control" placeholder="amount">
            <button type="submit" class="btn btn-info">Fund</button>
        </div>
        {!! $errors->first('financial_amount', '<span class="help-block">:message</span>' ) !!}
    </form>
</div>
