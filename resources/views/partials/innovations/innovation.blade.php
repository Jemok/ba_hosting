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
                — Posted in <strong><a href="#" class="inno-category">{{ $innovation->category->categoryName }}</a></strong> on <strong>May 21, 2014</strong></p>
            </header>

            <section class="innoDetails__content">
                <p>{!! $innovation->innovationShortDescription !!}</p>
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
            <a href="{{ url('innovation/portfolio/'.$innovation->id)}}">See who's invested so far</a>
        </div>
        @elseif($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
        <div class="alert alert-success" role="alert">
            <h4>Funded</h4>
            This innovation has been fully funded.<br><br>
            <a href="{{ url('innovation/portfolio/'.$innovation->id)}}">View funding history</a>
        </div>
        @endif
        
        <!-- If not show funding progress -->
        @if($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
           
            <a href="{{ url('innovation/portfolio/'.$innovation->id)}}"><button class="btn btn-success btn-block">View Innovation's Portfolio</button></a>
            
        @elseif($innovation->fundingStatus == 1 && $innovation->innovationFund > 0  )       
            <div class="innoData-list">
                <div class="innoData">
                    <div class="innoData__title">Funding Still Expected</div>
                    <div class="innoData__content">Ksh. {{ $innovation->innovationFund }}</div>
                </div>    
            </div>        
            @if(\Auth::user()->userCategory == 2)
            <form method="post" action="{{ url('innovation/fund/'.$innovation->id)}}">                    
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
    <!--
                    <div class="btn-group">
                        <a href="{{url('innovation/fund/'.$innovation->id)}}" class="btn btn-primary btn-block">Fund fully</a>
                        <button type="button" class="btn btn-block">Fund Partially</button>
                    </div>
    -->
                    <div class="innoData">
                        <div class="innoData__title">Your Balance after funding this</div>
                        <div class="innoData__content"> Ksh. {{ \Auth::user()->investor_amount - $innovation->innovationFund }}</div>
                    </div>
                    {!! $errors->first('partialFund', '<span class="help-block">:message</span>' ) !!}
                </div>

                <button type="submit" class="btn btn-primary btn-block">Proceed with Funding</button>
            </form>
                
<!--
                <a href="{{url('innovation/fund/'.$innovation->id)}}"><button class="cta cta_btn">Fully Fund this project</button></a>

                <br>or partially Fund this project
-->
            @endif            
        @elseif($innovation->fundingStatus == 0 )
            <div class="innoData-list">
                <div class="innoData">
                    <div class="innoData__title">Funding Needed</div>
                    <div class="innoData__content">Ksh. {{ $innovation->innovationFund }}</div>
                </div>
            </div>
            @if(\Auth::user()->userCategory == 2)
                <form method="post" action="{{ url('innovation/fund/'.$innovation->id)}}">
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
        <!--
                        <div class="btn-group">
                            <a href="{{url('innovation/fund/'.$innovation->id)}}" class="btn btn-primary btn-block">Fund fully</a>
                            <button type="button" class="btn btn-block">Fund Partially</button>
                        </div>
        -->
                        <div class="innoData">
                            <div class="innoData__title">Your Balance after funding this</div>
                            <div class="innoData__content"> Ksh. {{ \Auth::user()->investor_amount - $innovation->innovationFund }}</div>
                        </div>
                        {!! $errors->first('partialFund', '<span class="help-block">:message</span>' ) !!}
                    </div>

                    @if($chatWithInnovator == true)
                        <button type="submit" class="btn btn-primary btn-block">Proceed with Funding</button>
                    @else
                        <button type="submit" class="btn btn-primary btn-block" disabled>Converse with innovator first</button>
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