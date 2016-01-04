@if (count($errors) > 0)
<div class="alert alert-danger" role="alert" >
    <h5>Oh snap! <b>Change a few things up</b> and try submitting again!</h5>

    @foreach ($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</div>
@endif

<div class="ad ad_banner ad-h-250">
    <img src="{{ asset('/img/ad_1940x500_Teradata_Walker.png') }}">
</div>

<!--
<div class="ad ad_banner ad-h-90">
    <img src="{{ asset('/img/ad_720x90_Samsung_Galaxy.jpg') }}">
</div>
-->

<div class="container innovation-pane">
    <div class="col-lg-9">
        <article class="inno innoDetails education" data-category="education">
            <header class="innoDetails__header">
                <h2 class="inno-title">{{ $innovation->innovationTitle }}</h2>
                <p class="inno-meta">by <strong>  
                    @if(\Auth::user()->id  == $innovation->user_id)
                    <a href="{{ url('innovator/profile/'.$innovation->user->hash_id) }}">Me</a>
                    @else
                    <a class="inno-innovator" href="{{ url('innovator/profile/'.$innovation->user->hash_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a>
                    @endif
                </strong> 
                — Posted in <strong>

                        @if(!(\Auth::user()->isInnovator()))

                        <a href="{{ route('innovationCategory', $innovation->category_id) }}" class="inno-category">{{ $innovation->category->categoryName }}</a>

                        @else
                        <span class="inno-category">{{ $innovation->category->categoryName }}</span>

                        @endif

                        </strong> on <strong>{{ $innovation->created_at }}</strong></p>
            </header>

            <section class="innoDetails__content">
                <p>{{ $innovation->innovationShortDescription }}</p>
                {!! $innovation->innovationDescription !!}
            </section>

            <section class="innoDetails__content">
                <h4 class="section__title">What's the funding for?</h4>
                <p>{{ $innovation->justifyFund }}</p>    
            </section>

            <footer class="innoDetails__footer">
                @if(\Auth::user()->id  != $innovation->user_id)
                <hr>
                <section class="row">
                    <div class="col-md-3">
                        <h4 class="section__title">About this Innovator</h4>
                    </div>
                    <div class="col-md-9">
                        <p>{{ $innovation->user->more_details }}</p>
                    </div>
                </section>
                @endif

                <hr>
                <section class="row">
                    @if(\Auth::user()->isInvestor())

                        @include('partials.messenger.investor')

                    @elseif(\Auth::user()->isInnovator())

                        @include('partials.messenger.innovator')

                    @elseif(\Auth::user()->isMother())

                        @include('partials.messenger.mother')

                    @elseif(\Auth::user()->isAdmin())

                         @include('partials.messenger.expert')

                    @endif
                </section>
            </footer>
        </article>
    </div>

    <aside class="col-lg-3">
        <!-- If funding exists notify investors -->
        @if($innovation->fundingStatus == 1 && $innovation->innovationFund > 0  )
        <div class="alert alert-info" role="alert">
            This innovation has already began attracting funding from investors.<br><br>
            <a href="{{ route('innovationPortfolio',[$innovation->id])}}">See who's invested so far</a>
        </div>
        @elseif($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
        <div class="alert alert-success" role="alert">
            <h4>Funded</h4>
            This innovation has been fully funded.
        </div>

        <div class="innoData-list">
            <div class="collapse" id="viewFundingHistory">
                <div class="innoData">
                    <div class="innoData__title">Funding Needed</div>
                    <div class="innoData__content">Ksh. {{ $innovation->innovationFund }}</div>
                </div>
                <!-- For each funding load one of these -->
                <div class="innoData">
                    <div class="innoData__content">Ksh x</div>
                    <div class="innoData__meta">by y &middot; 1 hour ago</div>
                </div>

                <div class="innoData">
                    <div class="innoData__title">Total Funded</div>
                    <div class="innoData__content">Ksh. {{ $innovation->innovationFund }}</div>
                </div>
                <div class="innoData">
                    <div class="innoData__title">Still Expected</div>
                    <div class="innoData__content">Ksh. {{ $innovation->innovationFund }}</div>
                </div>
            </div>
        </div>
        
        <button type="button" data-toggle="collapse" data-target="#viewFundingHistory" aria-expanded="false" aria-controls="viewFundingHistory" class="btn btn-link btn-block collapsed" id="history" data-clicked="Hide Funding History">Show funding history</button>
        @endif
        
        <!-- If not show funding progress -->
        @if($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
           
            <a href="{{ route('innovationPortfolio', [$innovation->id])}}" class="btn btn-success btn-block">View Innovation's Portfolio</a>
            
        @elseif($innovation->fundingStatus == 1 && $innovation->innovationFund > 0  )       
            <div class="innoData-list">
                <div class="innoData">
                    <div class="innoData__title">Funding Still Expected</div>
                    <div class="innoData__content">Ksh. {{ $innovation->innovationFund }}</div>
                </div>    
            </div>        
            @if(\Auth::user()->userCategory == 2)
            <form method="post" action="{{ route('fundInnovation', [$innovation->id])}}">
                {!! CSRF_FIELD() !!}            
                <div class="innoData-list">
                    <div class="innoData">
                        <div class="innoData__title">Potential Funding Available</div>
                        <div class="innoData__content">Ksh. {{ \Auth::user()->investor_amount }}</div>
                    </div>
                    <div class="innoData form_field {{ $errors->has('partialFund') ? 'has-error' : ''}}" >
                        <label for="partialFund">Amount to invest in this project</label>
                        <div class="input-group">
                            <div class="input-group-addon">Ksh.</div>
                            <input type="text" name="partialFund" value="{{ $innovation->innovationFund }}" class="form-control" placeholder="amount">
                            <div class="input-group-addon">.00</div>
                        </div>
                    </div>

                    <div class="innoData">
                        <div class="innoData__title">Your Balance after funding this</div>
                        <div class="innoData__content"> Ksh. {{ \Auth::user()->investor_amount - $innovation->innovationFund }}</div>
                    </div>
                    @if(!(\Auth::user()->investor_amount == 0))
                    <div class="innoData">
                        <div class="innoData__title">Your Balance after funding this</div>
                        <div class="innoData__content"> Ksh. {{ \Auth::user()->investor_amount - $innovation->innovationFund }}</div>
                        @if((\Auth::user()->investor_amount - $innovation->innovationFund) <=0  )
                        <span class="alert-warning">You can only fund this innovation Ksh. {{ \Auth::user()->investor_amount }} maximum</span>
                        @else
                        <span class="alert-info">You can fund this innovation partially or full amount</span>
                        @endif
                    </div>
                    {!! $errors->first('partialFund', '<span class="help-block">:message</span>' ) !!}
                    @endif

                </div>
                @if(\Auth::user()->investor_amount > 0)

                @if($chatWithInnovator == true)
                <button type="submit" class="btn btn-primary btn-block" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Proceed with Funding</button>
                @elseif($chatWithInnovator == false)
                <button type="submit" class="btn btn-primary btn-block" disabled>Converse with innovator first</button>
                @endif

                @else
                <button type="submit" class="btn btn-danger btn-block" disabled>Not allowed, Your investment is low</button>
                @endif
            </form>
          @endif
        @elseif($innovation->fundingStatus == 0 )
            <div class="innoData-list">
                <div class="innoData">
                    <div class="innoData__title">Funding Needed</div>
                    <div class="innoData__content">Ksh. {{ $innovation->innovationFund }}</div>
                </div>
            </div>
            @if(\Auth::user()->userCategory == 2)
                <form method="post" action="{{ route('fundInnovation', [$innovation->id])}}">
                    {!! CSRF_FIELD() !!}
                    <div class="innoData-list">
                        <div class="innoData">
                            <div class="innoData__title">Potential Funding Available</div>
                            <div class="innoData__content">Ksh. {{ \Auth::user()->investor_amount }}</div>
                        </div>
                        @if(!(\Auth::user()->investor_amount == 0))
                        <div class="innoData form_field {{ $errors->has('partialFund') ? 'has-error' : ''}}" >
                            <label for="partialFund">Amount to invest in this project</label>
                            @if((\Auth::user()->investor_amount - $innovation->innovationFund) <=0  )
                            <span class="alert-warning">You can only fund this innovation Ksh. {{ \Auth::user()->investor_amount }} maximum</span>
                            @else
                            <span class="alert-info">You can fund this innovation partially or full amount</span>
                            @endif
                            <div class="input-group">
                                <div class="input-group-addon">Ksh.</div>
                                <input type="text" name="partialFund" value="{{ $innovation->innovationFund }}" class="form-control" placeholder="amount">
                                <div class="input-group-addon">.00</div>
                            </div>
                        </div>
                        <div class="innoData">
                            <div class="innoData__title">Your Balance after funding this</div>
                            <div class="innoData__content"> Ksh. {{ \Auth::user()->investor_amount - $innovation->innovationFund }}</div>
                        </div>
                        {!! $errors->first('partialFund', '<span class="help-block">:message</span>' ) !!}
                        @endif
                    </div>

                    @if(\Auth::user()->investor_amount > 0)

                    @if($chatWithInnovator == true)
                        <button type="submit" class="btn btn-primary btn-block" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Proceed with Funding</button>
                    @elseif($chatWithInnovator == false)
                        <button type="submit" class="btn btn-primary btn-block" disabled>Converse with innovator first</button>
                    @endif

                    @else
                        <button type="submit" class="btn btn-danger btn-block" disabled>Not allowed, Your investment is low</button>
                    @endif
                </form>
            @endif
        @endif
    </aside>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="{{ asset('/js/jquery.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        }
    });
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="//js.pusher.com/2.2/pusher.min.js"></script>
<script>
    var pusher = new Pusher("{{ env('PUSHER_KEY')}}");
</script>
<script src="{{ asset('js/pusher.js') }}"></script>