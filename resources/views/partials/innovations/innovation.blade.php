<!-- The partial for displaying a single innovation  -->

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

<div class="container innovation-pane" id="innovation_title" data-id="{{ $innovation->id }}">
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
            <section class="row" id="messages">
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
                <div class="innoData__content">Ksh. {{ number_format($innovation->innovationFund, 0) }}</div>
            </div>
            <!-- For each funding load one of these -->
            @if($funds->count())
            @foreach($funds as $fund)
            <div class="innoData">
                <div class="innoData__content">Ksh {{ number_format($fund->amount, 0)}}</div>
                <div class="innoData__meta">
                    @if(\Auth::user()->id == $fund->investor_id)

                    <a href="{{ url('investor/profile/'.$fund->investor->hash_id) }}">Me</a>

                    @else
                    <a href="{{ url('investor/profile/'.$fund->investor->hash_id) }}">{{$fund->name}}</a>
                    @endif &middot;
                    {!! $fund->created_at->diffForHumans() !!}
                </div>
            </div>
            @endforeach
            <div class="innoData">
                <div class="innoData__title">Total Funded</div>
                <div class="innoData__content">Ksh. {{ number_format($funds->sum('amount'), 0) }} </div>
            </div>
            <div class="innoData">
                <div class="innoData__title">Still Expected</div>
                <div class="innoData__content">Ksh. {{ number_format($totalNeeded, 0) }}</div>
            </div>
            @else
            <p class="alert-info"><h3>No fundings</h></h3><p>

                @endif
        </div>
    </div>

    <button type="button" data-toggle="collapse" data-target="#viewFundingHistory" aria-expanded="false" aria-controls="viewFundingHistory" class="btn btn-link btn-block collapsed" id="history" data-clicked="Hide Funding History">Show funding history</button>
    @endif

    <!-- If not show funding progress -->
    @if($innovation->fundingStatus == 1 && $innovation->innovationFund > 0  )
    <div class="innoData-list">
        <div class="innoData">
            <div class="innoData__title">Funding Still Expected</div>
            <div class="innoData__content">Ksh. {{ number_format($innovation->innovationFund, 0)}}</div>
        </div>
    </div>
    @if(\Auth::user()->userCategory == 2)
    <form method="post" action="{{ route('fundInnovation', [$innovation->id])}}">
        {!! CSRF_FIELD() !!}
        <div class="innoData-list">
            <div class="innoData">
                <div class="innoData__title">Potential Funding Available</div>
                <div class="innoData__content">Ksh. {{ number_format(\Auth::user()->investor_amount, 0) }}</div>
            </div>
            <div class="innoData form_field {{ $errors->has('partialFund') ? 'has-error' : ''}}" >
                <label for="partialFund">Amount to invest in this project</label>
                <div class="input-group">
                    <div class="input-group-addon">Ksh.</div>
                    <input type="text" name="partialFund" value="{{ $innovation->innovationFund }}" class="form-control" placeholder="amount">
                    <div class="input-group-addon">.00</div>
                </div>
            </div>
            @if(!(\Auth::user()->investor_amount == 0))
            <div class="innoData">
                <div class="innoData__title">Your Balance after funding this</div>
                <div class="innoData__content"> Ksh. {{ number_format(\Auth::user()->investor_amount - $innovation->innovationFund, 0)}}</div>
                @if((\Auth::user()->investor_amount - $innovation->innovationFund) <=0  )
                <span class="alert-warning">You can only fund this innovation Ksh. {{ number_format(\Auth::user()->investor_amount, 0) }} maximum</span>
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
            <div class="innoData__content">Ksh. {{ number_format($innovation->innovationFund, 0) }}</div>
        </div>
    </div>
    @if(\Auth::user()->userCategory == 2)
    <form method="post" action="{{ route('fundInnovation', [$innovation->id])}}">
        {!! CSRF_FIELD() !!}
        <div class="innoData-list">
            <div class="innoData">
                <div class="innoData__title">Potential Funding Available</div>
                <div class="innoData__content">Ksh. {{ number_format(\Auth::user()->investor_amount, 0) }}</div>
            </div>
            @if(!(\Auth::user()->investor_amount == 0))
            <div class="innoData form_field {{ $errors->has('partialFund') ? 'has-error' : ''}}" >
                <label for="partialFund">Amount to invest in this project</label>
                @if((\Auth::user()->investor_amount - $innovation->innovationFund) <=0  )
                <span class="alert-warning">You can only fund this innovation Ksh. {{ number_format(\Auth::user()->investor_amount, 0) }} maximum</span>
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
                <div class="innoData__content"> Ksh. {{ number_format(\Auth::user()->investor_amount - $innovation->innovationFund, 0) }}</div>
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
@if(\Auth::user()->isInvestor())
<script>
    $(function(){
        var active_tab_content = $(this).find('.tab-content');
        var active = active_tab_content.find('.active');
        var active_id = active.attr('id');
        var active_tab_data_id = active.attr('data-id');
        var form = active.find('.addForm').attr('id', active_id);
        var thread_id = active_tab_data_id;
        active.find('span').attr('class', 'label label-info label-pill text-info');
        $.ajax({
            url: "/messages/" + thread_id + "/read"
        });
        form.on('submit', function(e)
        {
            e.preventDefault();
            $(this).find('#help-block_'+thread_id).text('');
            var id = $('#innovation_title').data('id');
            var unique_id = form.attr('data-id');
            if(form.find('textarea').val() == '')
            {
                $(this).find('#help-block_'+thread_id).text('Type your message here:');
            }
            $.ajax( '/messages/' + id + '/unique-id/'+ unique_id, {
                data: form.serialize(),
                method: 'GET',
                success: function() {
                    addMessage(thread_id);
                }
            });
            form.find('textarea').val('');
            var submit = form.find('.send_message');
            submit.prop('disabled', false);
        });
    });
</script>
@endif

<script type="text/javascript">
    //variable definitions
    var show_tab = 'shown.bs.tab';
    //active tab
    var tab;
    //clicked tab data-id
    var target;
    //renders messagess new state to the page
    function addMessage( thread_id ) {
        $.get( "/messages/single/" + thread_id, function( data ) {
            $( ".messages_"+thread_id).append("<li>" + data + "</li>" );
        });
    }
    //Identify opened tab and submits message to tab's thread
    $(function () {
        $('a[data-toggle="tab"]').on(show_tab, function (e) {
            tab = $(e.target);
            target = tab.attr('data-id');
            var open_tab = $('.tab-content').find('#'+target);
            var open_tab_id = open_tab.attr('id');
            var open_tab_data_id = open_tab.attr('data-id');
            var form = $('#'+open_tab_id).find('.addForm').attr('id', open_tab_id);
            var thread_id = open_tab_data_id;
            tab.find('span').attr('class', 'label label-info label-pill text-info');
            $.ajax({
                url: "/messages/" + thread_id + "/read"
            });
            form.on('submit', function(e)
            {
                e.preventDefault();
                $(this).find('#help-block_'+thread_id).text('');
                var id = $('#innovation_title').data('id');
                var unique_id = form.attr('data-id');
                if(form.find('textarea').val() == '')
                {
                    $(this).find('#help-block_'+thread_id).text('Type your message here:');
                }
                $.ajax( '/messages/' + id + '/unique-id/'+ unique_id, {
                    data: form.serialize(),
                    method: 'GET',
                    success: function() {
                        addMessage(thread_id);
                    }
                });
                form.find('textarea').val('');
                var submit = form.find('.send_message');
                submit.prop('disabled', false);
            });
        })
    });
</script>
