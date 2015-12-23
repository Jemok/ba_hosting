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

@if(\Auth::user()->isInnovator())

    @if(\Auth::user()->id == $profile->id)
        <form method="post" action="{{ url('innovator/profile/update/'.$profile->id) }}" class="profile">
            <h3 class="section__title">Personal Profile</h3>
            <fieldset name="personal" class="form__cluster">

                {!! CSRF_FIELD() !!}
                <div class="form-group">
                    <div class="form__field pro__pic">
                        <label>User profile pic</label>
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
                            <div class="form__field {{ $errors->has('email') ? 'has-error' : ''}}" >
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
                <button type="submit" class="btn btn-primary">Save</button>
            </footer>
        </form>
    @else

    <form method="get" class="profile">
        <h3 class="section__title">Personal Profile</h3>
        <fieldset name="personal" class="form__cluster">
            <div class="form-group">
                <div class="form__field pro__pic">
                    <label>User profile pic</label>
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
                    <label>About you</label>
                    <div class="form-control">{{$profile->more_details}}</div>
                </div>
            </div>
        </fieldset>
    </form>
    @endif

@endif

@if(\Auth::user()->isInvestor())

    <form method="get" class="profile">
        <h3 class="section__title">Personal Profile</h3>
        <fieldset name="personal" class="form__cluster">
            <div class="form-group">
                <div class="form__field pro__pic">
                    <label>User profile pic</label>
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
                    <div class="form-control">-</div>
                </div>
                <div class="form__field">
                    <label>Job Title</label>
                    <div class="form-control">Job Title</div>
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>About you</label>
                    <div class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis lectus metus, at posuere neque. Sed pharetra nibh eget orci convallis at posuere leo convallis. Sed blandit augue vitae augue scelerisque bibendum. Vivamus sit amet libero turpis, non venenatis urna. In blandit, odio convallis suscipit venenatis, ante ipsum cursus augue.</div>
                </div>
            </div>
        </fieldset>
        
        <h3 class="section__title">Virtual Bank Account</h3>
        <fieldset name="financial" class="form__cluster">
            <div class="form-group">
                <div class="form__field">
                    <label>Funding Available (Ksh.)</label>
                    <div class="form-control">-</div>
                </div>
                <div class="form__field">
                    <label>Funding Injected (Ksh.)</label>
                    <div class="form-control">-</div>
                </div>
            </div>
        </fieldset>
    </form>

@endif

@if(\Auth::user()->isAdmin())

    <form method="get" class="profile">
        <h3 class="section__title">Personal Profile</h3>
        <fieldset name="personal" class="form__cluster">
            <div class="form-group">
                <div class="form__field pro__pic">
                    <label>User profile pic</label>
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
                    <div class="form-control">-</div>
                </div>
                <div class="form__field">
                    <label>Job Title</label>
                    <div class="form-control">Job Title</div>
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>About you</label>
                    <div class="form-control">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus quis lectus metus, at posuere neque. Sed pharetra nibh eget orci convallis at posuere leo convallis. Sed blandit augue vitae augue scelerisque bibendum. Vivamus sit amet libero turpis, non venenatis urna. In blandit, odio convallis suscipit venenatis, ante ipsum cursus augue.</div>
                </div>
            </div>
            <div class="form-group">
                <div class="form__field">
                    <label>Field(s) of expertise</label>
                    <div class="form-control">Arts, Crafts, Design</div>
                </div>
            </div>
        </fieldset>
    </form>

@endif

@if(\Auth::user()->isMother())

    <form method="get" class="profile">
        <h3 class="section__title">Profile</h3>
        <fieldset name="personal" class="form__cluster">
            <div class="form-group">
                <div class="form__field pro__pic">
                    <label>User profile pic</label>
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

</div>
@stop
