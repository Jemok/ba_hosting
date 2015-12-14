<div class="col-lg-12">
    <div class="ad ad_banner">
        Banner ad
    </div>
</div> <!-- end col-lg-9 -->

<div class="container innovation-pane">
<div class="col-lg-9">
<article class="inno innoDetails education" data-category="education">
<header class="innoDetails__header">
    <hgroup>
        <h3 class="inno-title">{{ $innovation->innovationTitle }}</h3>

        @if(\Auth::user()->id  == $innovation->user_id)
        <h4 class="inno-innovator">by <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">Me</a></h4>
        @else
        <h4 class="inno-innovator">by <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a></h4>
        @endif
    </hgroup>
    <div class="inno-meta">
        Filed under <a href="#" class="inno-category">{{ $innovation->category->categoryName }}</a>
    </div>
</header>
<section class="innoDetails__content">
    <p class="inno-summary">

        {!! $innovation->innovationDescription !!}

    </p>
    <!--<h4>What is Robo Wunderkind?</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis lectus metus, at posuere neque. Sed pharetra nibh eget orci convallis at posuere leo convallis. Sed blandit augue vitae augue scelerisque bibendum. Vivamus sit amet libero turpis, non venenatis urna. In blandit, odio convallis suscipit venenatis, ante ipsum cursus augue.</p>
    <p>Et mollis nunc diam eget sapien. Nulla facilisi. Etiam feugiat imperdiet rhoncus. Sed suscipit bibendum enim, sed volutpat tortor malesuada non. Morbi fringilla dui non purus porttitor mattis. Suspendisse quis vulputate risus. Phasellus erat velit, sagittis sed varius volutpat, placerat nec urna. Nam eu metus vitae dolor fringilla feugiat. Nulla.</p>
    <h4>How does it work?</h4>
    <p>Facilisi. Etiam enim metus, luctus in adipiscing at, consectetur quis sapien. Duis imperdiet egestas ligula, quis hendrerit ipsum ullamcorper et. Phasellus id tristique orci. Proin consequat mi at felis scelerisque ullamcorper. Etiam tempus, felis vel eleifend porta, velit nunc mattis urna, at ullamcorper erat diam dignissim ante. Pellentesque justo risus.</p>
    -->
</section>
<hr>
<footer class="innoDetails__footer">
<!--<section class="row">
    <div class="col-md-3">
        <h4>About this Innovator</h4>
    </div>
    <div class="col-md-9">
        <div class="media">
            <div class="media-body">
                <p>Facilisi. Etiam enim metus, luctus in adipiscing at, consectetur quis sapien. Duis imperdiet egestas ligula, quis hendrerit ipsum ullamcorper et. Phasellus id tristique orci. Proin consequat mi at felis scelerisque ullamcorper. Etiam tempus, felis vel eleifend porta, velit nunc mattis urna, at ullamcorper erat diam dignissim ante. Pellentesque justo risus.</p>
            </div>
        </div>
    </div>
</section>
<hr>-->

<section class="row">

    @if(\Auth::user()->userCategory == 2)

    @if($threads_count > 0)

    <div class="row">
        <div class="col-sm-6">
            <h4 class="text-center">Chats</h4>
            <div class="container">
                @if (Session::has('error_message'))
                <div class="alert alert-danger" role="alert">
                    {!! Session::get('error_message') !!}
                </div>
                @endif
                @if($threads->count() > 0)
                @foreach($threads as $thread)
                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                <div id="thread_list_{{$thread->id}}" class="col-md-4 media alert {!!$class!!}">
                    <h6 class="media-heading">Reply to : {!! link_to('messages/' . $thread->id, $thread->subject) !!}</h6>
                    <p id="thread_list_{{$thread->id}}_text">Message : {!! $thread->latestMessage->body !!}</p>
                    <p><small><strong>A chat with:</strong> {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</small></p>
                </div>
                @endforeach
                @else
                <p>Sorry, no chats here</p>
                @endif
            </div>
        </div>
    </div>

    @else
    <div class="container">
        <h5>Start a chat with <h4 class="inno-innovator">by <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a></h4> about {{ $innovation->innovationTitle }} </h5>
        {!! Form::open(['route' => 'messages.store']) !!}
        <div class="col-md-6">
            <!-- Subject Form Input -->
            <input type="hidden" name="innovation_id" value="{{$innovation->id}}">
            <div class="form-group">
                <!--{!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}-->
                <!--{!! Form::hidden('subject', null, ['class' => 'form-control', 'value' => '{{\Auth::user()->fullName()}}']) !!}-->
                <input type="hidden" name="subject" value="{{\Auth::user()->fullName()}}">
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                {!! Form::label('message', 'Your Message:', ['class' => 'control-label']) !!}
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            </div>

            <input type="hidden" name="recipients[]" value="{!!$innovation->user->id!!}">

            <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    @endif

    @elseif(\Auth::user()->userCategory == 1)


    <a href="{{ url('messages/'.$innovation->id.'/create-mother/')}}"><button class="btn btn-info">+New chat with moderator</button></a>
    <a href="{{ url('messages/'.$innovation->id.'/create-expert/')}}"><button class="btn btn-info">+New chat with expert</button></a>


    <div class="row">
        <div class="col-sm-6">
            <h4 class="text-center">Chats</h4>
            <div class="container">
                @if (Session::has('error_message'))
                <div class="alert alert-danger" role="alert">
                    {!! Session::get('error_message') !!}
                </div>
                @endif
                @if($threads->count() > 0)
                @foreach($threads as $thread)
                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                <div id="thread_list_{{$thread->id}}" class="col-md-4 media alert {!!$class!!}">
                    <h4 class="media-heading">Reply to : {!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                    <p id="thread_list_{{$thread->id}}_text">Message : {!! $thread->latestMessage->body !!}</p>
                    <p><small><strong>A chat with:</strong> {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</small></p>
                </div>
                @endforeach
                @else
                <p>Sorry, no chats.</p>
                @endif
            </div>
        </div>
    </div>

    @elseif(\Auth::user()->userCategory == 4)


    @if($threads_count > 0)

    <div class="row">
        <div class="col-sm-6">
            <h4 class="text-center">Chats</h4>
            <div class="container">
                @if (Session::has('error_message'))
                <div class="alert alert-danger" role="alert">
                    {!! Session::get('error_message') !!}
                </div>
                @endif
                @if($threads->count() > 0)
                @foreach($threads as $thread)
                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                <div id="thread_list_{{$thread->id}}" class="col-md-4 media alert {!!$class!!}">
                    <h6 class="media-heading">Reply to : {!! link_to('messages/' . $thread->id, $thread->subject) !!}</h6>
                    <p id="thread_list_{{$thread->id}}_text">Message : {!! $thread->latestMessage->body !!}</p>
                    <p><small><strong>A chat with:</strong> {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</small></p>
                </div>
                @endforeach
                @else
                <p>Sorry, no chats from investors.</p>
                @endif
            </div>
        </div>
    </div>

    @else
    <div class="container">
        <h5>Start a chat with <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a> about {{ $innovation->innovationTitle }} </h5>
        {!! Form::open(['route' => 'messages.store']) !!}
        <div class="col-md-6">
            <!-- Subject Form Input -->
            <input type="hidden" name="innovation_id" value="{{$innovation->id}}">
            <div class="form-group">
                <!--{!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}-->
                <!--{!! Form::hidden('subject', null, ['class' => 'form-control', 'value' => '{{\Auth::user()->fullName()}}']) !!}-->
                <input type="hidden" name="subject" value="{{\Auth::user()->fullName()}}">
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                {!! Form::label('message', 'Your Message:', ['class' => 'control-label']) !!}
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            </div>

            <input type="hidden" name="recipients[]" value="{!!$innovation->user->id!!}">

            <!-- Submit Form Input -->
            <div class="form-group">
                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    @endif
    @elseif(\Auth::user()->userCategory == 3)


    <a href="{{ url('messages/'.$innovation->id.'/create-mother/')}}"><button class="btn btn-info">+New chat with moderator</button></a>
    <a href="{{ url('messages/'.$innovation->id.'/create-expert/')}}"><button class="btn btn-info">+New chat with expert</button></a>


    <div class="row">
        <div class="col-sm-6">
            <h4 class="text-center">Chats</h4>
            <div class="container">
                @if (Session::has('error_message'))
                <div class="alert alert-danger" role="alert">
                    {!! Session::get('error_message') !!}
                </div>
                @endif
                @if($threads->count() > 0)
                @foreach($threads as $thread)
                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                <div id="thread_list_{{$thread->id}}" class="col-md-4 media alert {!!$class!!}">
                    <h4 class="media-heading">Reply to : {!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                    <p id="thread_list_{{$thread->id}}_text">Message : {!! $thread->latestMessage->body !!}</p>
                    <p><small><strong>A chat with:</strong> {!! $thread->participantsString(Auth::id(), ['first_name']) !!}</small></p>
                </div>
                @endforeach
                @else
                <p>Sorry, no chats.</p>
                @endif
            </div>
        </div>
    </div>
    @endif
</section>
</footer>
</article>
</div>

<aside class="col-lg-3">
    <div class="innoData-list">
        <div class="innoData">
            <div class="innoData__title">Funding Needed</div>
            <div class="innoData__content">Ksh ({{ $innovation->innovationFund }})</div>
            @if($innovation->fundingStatus == 1 && $innovation->innovationFund > 0  )

            <a href="{{ url('innovation/portfolio/'.$innovation->id)}}"><button class="btn btn-success">Partially funded</button></a>
            <a href="{{ url('innovation/portfolio/'.$innovation->id)}}"><button class="btn btn-success">Portfollio</button></a>

            @if(\Auth::user()->userCategory == 2)
            <div class="innoData-list">
                <div class="innoData">
                    <div class="innoData__title">Potential Funding Available</div>
                    <div class="innoData__content">Ksh. 71,000,500</div>
                </div>
                <div class="innoData">
                    <div class="innoData__title">Your Balance after funding this</div>
                    <div class="innoData__content">Ksh. 70,000,500</div>
                </div>
            </div>
            <a href="{{url('innovation/fund/'.$innovation->id)}}"><button class="cta cta_btn">Fully Fund this project</button></a>

            <br>or partially Fund this project

            <form method="post" action="{{ url('innovation/fund/'.$innovation->id)}}">
                {!! CSRF_FIELD() !!}

                <label for="partialFund">Amount</label>
                <input type="text" name="partialFund">
                <button type="submit" class="cta cta_btn">Fund</button>
            </form>
            @endif
            @endif
            @if($innovation->fundingStatus == 1 && $innovation->innovationFund <= 0)
            <button class="btn btn-success">Fully funded</button>
            <a href="{{ url('innovation/portfolio/'.$innovation->id)}}"><button class="btn btn-success">Portfollio</button></a>
            @endif
        </div>
    </div>

    @if(\Auth::user()->userCategory == 2)
    @if($innovation->fundingStatus == 0 )

    <div class="innoData-list">
        <div class="innoData">
            <div class="innoData__title">Potential Funding Available</div>
            <div class="innoData__content">Ksh. 71,000,500</div>
        </div>
        <div class="innoData">
            <div class="innoData__title">Your Balance after funding this</div>
            <div class="innoData__content">Ksh. 70,000,500</div>
        </div>
    </div>
    <a href="{{url('innovation/fund/'.$innovation->id)}}"><button class="cta cta_btn">Fully Fund this project</button></a>

    <br>or partially Fund this project

    <form method="post" action="{{ url('innovation/fund/'.$innovation->id)}}">
        {!! CSRF_FIELD() !!}

        <label for="partialFund">Amount</label>
        <input type="text" name="partialFund">
        <button type="submit" class="cta cta_btn">Fund</button>
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