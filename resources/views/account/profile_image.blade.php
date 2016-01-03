
{!! Form::open(array('url'=>'apply/upload','method'=>'POST', 'files'=>true, 'class'=>'profile')) !!}
<div class="section__title">Edit Profile Image</div>
<div class="control-group">
    <div class="controls">
        {!! Form::file('image') !!}
        <p class="errors text-danger">{!!$errors->first('image')!!}</p>
        @if(Session::has('error'))
        <p class="errors text-danger">{!! Session::get('error') !!}</p>
        @endif
    </div>
</div>
<div id="success"> </div>
<footer class="form__footer">
    {!! Form::submit('Upload', array('class'=>'btn btn-primary', 'onclick' => "this.disabled=true;this.value='Sending, please wait...';this.form.submit();" )) !!}
</footer>
{!! Form::close() !!}
