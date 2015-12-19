@if (count($errors) > 0)
<div class="alert alert-danger" role="alert" >
    <h5>Oh snap! <b>Change a few things up</b> and try submitting again!</h5>

    @foreach ($errors->all() as $message)


    <li>{{ $message }}</li>


    @endforeach
</div>
@endif
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

        <h4 class="inno-meta"> 
            @if(\Auth::user()->id  == $innovation->user_id)
            <a href="{{ url('innovator/profile/'.$innovation->user_id) }}">Me</a>
            @else
            <a class="inno-innovator" href="{{ url('innovator/profile/'.$innovation->user_id) }}">{{ $innovation->user->first_name }} {{ $innovation->user->last_name }}</a>
            @endif
            <span class="inno-divider">|</span>
            <a href="#" class="inno-category">{{ $innovation->category->categoryName }}</a>
        </h4>
    </hgroup>
</header>
<section class="innoDetails__content">
    <p class="inno-summary">
    <h4>About my innovation</h4>
        {!! $innovation->innovationDescription !!}
    </p>
    <h4>What's the funding for?</h4>
    <p>{{ $innovation->justifyFund }}</p>
</section>
<footer class="innoDetails__footer">
    @if(\Auth::user()->id  != $innovation->user_id)
    <hr>
    <section class="row">
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
    @endif
<hr>

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
                    <div class="innoData__content">Ksh. {{ \Auth::user()->investor_amount }}</div>
                </div>
                <div class="innoData">
                    <div class="innoData__title">Your Balance after funding this</div>
                    <div class="innoData__content">
                        Ksh. {{ \Auth::user()->investor_amount - $innovation->innovationFund }}
                    </div>
                </div>
            </div>
            <a href="{{url('innovation/fund/'.$innovation->id)}}"><button class="cta cta_btn">Fully Fund this project</button></a>

            <br>or partially Fund this project

            <form method="post" action="{{ url('innovation/fund/'.$innovation->id)}}">
                {!! CSRF_FIELD() !!}

                <div class="form_field {{ $errors->has('partialFund') ? 'has-error' : ''}}" >
                    <label for="partialFund">Amount</label>
                    <input type="text" name="partialFund" value="{{ old('partialFund') }}" class="form-control" placeholder="amount">
                    <button type="submit" class="cta cta_btn">Fund</button>
                </div>
                {!! $errors->first('partialFund', '<span class="help-block">:message</span>' ) !!}
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
            <div class="innoData__content">Ksh. {{ \Auth::user()->investor_amount }}</div>
        </div>
        <div class="innoData">
            <div class="innoData__title">Your Balance after funding this</div>
            <div class="innoData__content"> Ksh. {{ \Auth::user()->investor_amount - $innovation->innovationFund }}</div>
        </div>
    </div>
    <a href="{{url('innovation/fund/'.$innovation->id)}}"><button class="cta cta_btn">Fully Fund this project</button></a>

    <br>or partially Fund this project

    <form method="post" action="{{ url('innovation/fund/'.$innovation->id)}}">
        {!! CSRF_FIELD() !!}
        <div class="form_field {{ $errors->has('partialFund') ? 'has-error' : ''}}" >
            <label for="partialFund">Amount</label>
            <input type="text" name="partialFund" value="{{ old('partialFund') }}" class="form-control" placeholder="amount">
            <button type="submit" class="cta cta_btn">Fund</button>
        </div>
        {!! $errors->first('partialFund', '<span class="help-block">:message</span>' ) !!}
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