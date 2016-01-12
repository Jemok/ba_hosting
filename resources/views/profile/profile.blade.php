@extends('layout')

@section('content')
<div class="container">

@if(Session::has('flash_message'))

<div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
    @if(Session::has('flash_message_important'))

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    @endif

    {{ session('flash_message') }}

</div>
@endif

@if(Session::has('flash_message_error'))

<div class="alert-message alert alert-danger {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
    @if(Session::has('flash_message_important'))

    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    @endif

    {{ session('flash_message_error') }}

</div>
@endif



<!-- Alert for errors in profile submission form -->
@if (count($errors) > 0)
<div class="alert alert-danger" role="alert" >
    <h6>Oh snap! Failed to update, <b>Change a few things up</b> and try submitting again!</h6>
</div>
@endif

@if(Request::is('innovator/profile/*'))

    @if(\Auth::user()->isInnovator() && \Auth::user()->id == $profile->id)
        <form method="post" action="{{ url('innovator/profile/update/'.$profile->id) }}" class="profile">

            {!! CSRF_FIELD() !!}
            <h3 class="section__title">Edit Personal Profile</h3>
            <fieldset name="personal" class="form__cluster">
                <div class="form-group">
                    <div class="form__field pro__pic">
                        @include('account.profile_image')
                    </div>
                    <div class="form__field">
                        <div class="form-group">
                            <div class="form__field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
                                <label>First Name</label>
                                {!! $errors->first('first_name', '<label class="help-block">:message</label>' ) !!}
                                <input name="first_name" class="form-control" value="{{$profile->first_name}}">
                            </div>
                            <div class="form__field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
                                <label>Last Name</label>
                                {!! $errors->first('last_name', '<label class="help-block">:message</label>' ) !!}
                                <input name="last_name" class="form-control" value="{{$profile->last_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form__field">
                                <label>Email</label>
                                {!! $errors->first('email', '<label class="help-block">:message</label>' ) !!}
                                <input name="email" class="form-control" value="{{$profile->email}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__field {{ $errors->has('more_details') ? 'has-error' : ''}}" >
                        <label>About you</label>
                        {!! $errors->first('more_details', '<label class="help-block">:message</label>' ) !!}
                        <input name="more_details" class="form-control" value="{{$profile->more_details}}">
                    </div>
                </div>
            </fieldset>

            <footer class="form__footer">
                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Save</button>
            </footer>
        </form>
        
    @include('account.change_password')
    @else
    <form method="get" class="profile">
        <h3 class="section__title">Innovator Personal Profile</h3>
        <fieldset name="personal" class="form__cluster">
            <div class="form-group">
                <div class="form__field pro__pic">
                    @if($profile->prof_pic->image != null)
                    <img src="{{ asset('uploads/'.$profile->prof_pic->image)}}" height="160" width="160">
                    @else
                    <img src="{{ asset('uploads/default.png')}}">
                    @endif

                </div>
                <div class="form__field">
                    <div class="form-group">
                        <div class="form__field">
                            <label>First Name</label>
                            <div class="form-control">{{$profile->first_name}}</div>
                        </div>
                        <div class="form__field">
                            <label>Last Name</label>
                            <div class="form-control">{{$profile->last_name}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label>Email</label>
                            <div class="form-control">{{$profile->email}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>About Innovator</label>
                    <div class="form-control">{{$profile->more_details}}</div>
                </div>
            </div>
        </fieldset>
    </form>
    @endif

@endif

@if(Request::is('investor/profile/*'))

    @if(\Auth::user()->isInvestor() && \Auth::user()->id == $profile->id)
        <form method="post" action="{{ url('investor/profile/update/'.$profile->id) }}" class="profile">
            <h3 class="section__title">Edit Personal Profile</h3>
            <fieldset name="personal" class="form__cluster">

                {!! CSRF_FIELD() !!}
                <div class="form-group">
                    <div class="form__field pro__pic">
                        @if(\Auth::user()->prof_pic()->first()->image != null)
                        <img src="{{ asset('uploads/'.\Auth::user()->prof_pic()->first()->image)}}" height="160" width="160">
                        @else
                        <img src="{{ asset('uploads/default.png')}}">
                        @endif

                    </div>
                    <div class="form__field">
                        <div class="form-group">
                            <div class="form__field {{ $errors->has('first_name') ? 'has-error' : ''}}" >
                                <label>First Name</label>
                                {!! $errors->first('first_name', '<label class="help-block">:message</label>' ) !!}
                                <input name="first_name" class="form-control" value="{{$profile->first_name}}">
                            </div>
                            <div class="form__field {{ $errors->has('last_name') ? 'has-error' : ''}}" >
                                <label>Last Name</label>
                                {!! $errors->first('last_name', '<label class="help-block">:message</label>' ) !!}
                                <input name="last_name" class="form-control" value="{{$profile->last_name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form__field">
                                <label>Email</label>
                                {!! $errors->first('email', '<label class="help-block">:message</label>' ) !!}
                                <input type="text" name="email" class="form-control" value="{{$profile->email}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form__field">
                        <label>Company</label>
                        {!! $errors->first('company', '<label class="help-block">:message</label>' ) !!}
                        <input name="company" type="text" value="{{ $profile->investor_request->company }}" class="form-control">
                    </div>
                    <div class="form__field">
                        <label>Job Title</label>
                        {!! $errors->first('job_title', '<label class="help-block">:message</label>' ) !!}
                        <input name="job_title" type="text" value="{{ $profile->investor_request->job_title }}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__field">
                        <label>About you</label>
                        {!! $errors->first('more_details', '<label class="help-block">:message</label>' ) !!}
                        <input name="more_details" value="{{ $profile->more_details }}" class="form-control">
                    </div>
                </div>
            </fieldset>

            <h3 class="section__title">Edit Virtual Bank Account</h3>
            <fieldset name="financial" class="form__cluster">
                <div class="form-group">
                    <div class="form__field {{ $errors->has('financial_amount') ? 'has-error' : ''}}">
                        <label>Funding Available (Ksh.)</label>
                        {!! $errors->first('financial_amount', '<label class="help-block">:message</label>' ) !!}
                        <input name="financial_amount" value="{{$profile->investor_amount}}" class="form-control">
                    </div>
                    <div class="form__field">
                        <label>Funding Injected (Ksh.)</label>
                        <div class="form-control">{{$profile->fund->sum('amount')}}</div>
                    </div>
                </div>
            </fieldset>

            <footer class="form__footer">
                <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Save</button>
            </footer>
        </form>
        @include('account.profile_image')

        @include('account.change_password')

    @else
    <form method="get" class="profile">
        <h3 class="section__title">Investor Personal Profile</h3>
        <fieldset name="personal" class="form__cluster">
            <div class="form-group">
                <div class="form__field pro__pic">
                    @if($profile->prof_pic->image != null)
                    <img src="{{ asset('uploads/'.$profile->prof_pic->image)}}" height="160" width="160">
                    @else
                    <img src="{{ asset('uploads/default.png')}}">
                    @endif

                </div>
                <div class="form__field">
                    <div class="form-group">
                        <div class="form__field">
                            <label>First Name</label>
                            <div class="form-control">{{$profile->first_name}}</div>
                        </div>
                        <div class="form__field">
                            <label>Last Name</label>
                            <div class="form-control">{{$profile->last_name}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label>Email</label>
                            <div class="form-control">{{$profile->email}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>Company</label>
                    <div class="form-control">{{ $profile->investor_request->company }}</div>
                </div>
                <div class="form__field">
                    <label>Job Title</label>
                    <div class="form-control">{{ $profile->investor_request->job_title }}</div>
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>About you</label>
                    <div class="form-control">{{ $profile->more_details }}</div>
                </div>
            </div>
        </fieldset>
        
        <h3 class="section__title">Investor Virtual Bank Account</h3>
        <fieldset name="financial" class="form__cluster">
            <div class="form-group">
                <div class="form__field">
                    <label>Funding Available (Ksh.)</label>
                    <div class="form-control">{{ $profile->investor_amount }}</div>
                </div>
                <div class="form__field">
                    <label>Funding Injected (Ksh.)</label>
                    <div class="form-control">{{$profile->fund->sum('amount')}}</div>
                </div>
            </div>
        </fieldset>
    </form>
    @endif
@endif

@if(Request::is('expert/profile/*'))

    @if(\Auth::user()->isAdmin() && \Auth::user()->id == $profile->id)

    <form method="post" action="{{ url('expert/profile/update/'.$profile->id) }}" class="profile">
        <h3 class="section__title">Edit Personal Profile</h3>
        {!! CSRF_FIELD() !!}
        <fieldset name="personal" class="form__cluster">
            <div class="form-group">
                <div class="form__field pro__pic">
                    @if(\Auth::user()->prof_pic()->first()->image != null)
                    <img src="{{ asset('uploads/'.\Auth::user()->prof_pic()->first()->image)}}" height="160" width="160">
                    @else
                    <img src="{{ asset('uploads/default.png')}}">
                    @endif

                </div>
                <div class="form__field">
                    <div class="form-group">
                        <div class="form__field">
                            <label>First Name</label>
                            {!! $errors->first('first_name', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="first_name" value="{{ $profile->first_name }}" class="form-control">
                        </div>
                        <div class="form__field">
                            <label>Last Name</label>
                            {!! $errors->first('last_name', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="last_name" value="{{ $profile->last_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label>Email</label>
                            {!! $errors->first('email', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="email" value="{{ $profile->email }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>Company</label>
                    {!! $errors->first('company', '<label class="help-block">:message</label>' ) !!}
                    <input name="company" type="text" value="{{ $profile->bongo_request->company }}" class="form-control">
                </div>
                <div class="form__field">
                    <label>Job Title</label>
                    {!! $errors->first('job_title', '<label class="help-block">:message</label>' ) !!}
                    <input name="job_title" type="text" value="{{ $profile->bongo_request->job_title }}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>About you</label>
                    {!! $errors->first('more_details', '<label class="help-block">:message</label>' ) !!}
                    <input type="text" name="more_details" value="{{ $profile->more_details }}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>Field(s) of expertise</label>
                    {!! $errors->first('field', '<label class="help-block">:message</label>' ) !!}
                    <input name="field" type="text" value="{{ $profile->bongo_request->field }}" class="form-control">
                </div>
            </div>
         </fieldset>

        <footer class="form__footer">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Save</button>
        </footer>
    </form>

    @include('account.profile_image')

    @include('account.change_password')

    @else
        <form method="get" class="profile">
            <h3 class="section__title">Expert Personal Profile</h3>
            <fieldset name="personal" class="form__cluster">
                <div class="form-group">
                    <div class="form__field pro__pic">
                        @if($profile->prof_pic->image != null)
                        <img src="{{ asset('uploads/'.$profile->prof_pic->image)}}" height="160" width="160">
                        @else
                        <img src="{{ asset('uploads/default.png')}}">
                        @endif
                    </div>
                    <div class="form__field">
                        <div class="form-group">
                            <div class="form__field">
                                <label>First Name</label>
                                <div class="form-control">{{$profile->first_name}}</div>
                            </div>
                            <div class="form__field">
                                <label>Last Name</label>
                                <div class="form-control">{{$profile->last_name}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form__field">
                                <label>Email</label>
                                <div class="form-control">{{$profile->email}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__field">
                        <label>Company</label>
                        <div class="form-control">{{ $profile->bongo_request->company }}</div>
                    </div>
                    <div class="form__field">
                        <label>Job Title</label>
                        <div class="form-control">{{ $profile->bongo_request->job_title }}</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__field">
                        <label>About you</label>
                        <div class="form-control">{{ $profile->more_details }}</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__field">
                        <label>Field(s) of expertise</label>
                        <div class="form-control">{{ $profile->bongo_request->field }}</div>
                    </div>
                </div>
            </fieldset>
        </form>
    @endif

@endif

@if(Request::is('mother/profile/*'))

    @if(\Auth::user()->isMother() && \Auth::user()->id == $profile->id)
    <form method="post" action="{{ url('mother/profile/update/'.$profile->id) }}" class="profile">
        <h3 class="section__title">Edit Profile</h3>
        <fieldset name="personal" class="form__cluster">

            {{ CSRF_FIELD() }}

            <div class="form-group">
                <div class="form__field pro__pic">
                    @if(\Auth::user()->prof_pic()->first()->image != null)
                    <img src="{{ asset('uploads/'.\Auth::user()->prof_pic()->first()->image)}}" height="160" width="160">
                    @else
                    <img src="{{ asset('uploads/default.png')}}">
                    @endif

                </div>
                <div class="form__field">
                    <div class="form-group">
                        <div class="form__field">
                            <label>First Name</label>
                            {!! $errors->first('first_name', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="first_name" value="{{ $profile->first_name }}" class="form-control">
                        </div>
                        <div class="form__field">
                            <label>Last Name</label>
                            {!! $errors->first('last_name', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="last_name" value="{{ $profile->last_name }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label>Email</label>
                            {!! $errors->first('email', '<label class="help-block">:message</label>' ) !!}
                            <input type="text" name="email" value="{{ $profile->email }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <footer class="form__footer">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Save</button>
        </footer>
    </form>

    @include('account.profile_image')

    @include('account.change_password')

    @else
        <form method="get"  class="profile">
            <h3 class="section__title">Moderator Profile</h3>
            <fieldset name="personal" class="form__cluster">
                <div class="form-group">
                    <div class="form__field pro__pic">
                        @if($profile->prof_pic->image != null)
                        <img src="{{ asset('uploads/'.$profile->prof_pic->image)}}" height="160" width="160">
                        @else
                        <img src="{{ asset('uploads/default.png')}}">
                        @endif
                    </div>
                    <div class="form__field">
                        <div class="form-group">
                            <div class="form__field">
                                <label>First Name</label>
                                <div class="form-control">{{$profile->first_name}}</div>
                            </div>
                            <div class="form__field">
                                <label>Last Name</label>
                                <div class="form-control">{{$profile->last_name}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form__field">
                                <label>Email</label>
                                <div class="form-control">{{$profile->email}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    @endif

@endif
</div>
@stop
