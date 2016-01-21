<!-- Displays the upload image view  -->
{!! Form::open(array('url'=>'apply/upload','method'=>'POST', 'files'=>true, 'class'=>'profile')) !!}
<section class="pro__pic-container">
    <header class="help-block">
        {!!$errors->first('image')!!}
    </header>
    <label for="pro__pic-upload" class="pro__pic-label" id="pro__pic-label">
        <span class="ion-edit"></span>
    </label>
    @if(\Auth::user()->prof_pic()->first()->image != null)
        <div id="pro__pic-preview" class="pro__pic-preview" style="background-image: url({{ asset('uploads/'.\Auth::user()->prof_pic()->first()->image)}})"></div>
    @else
        <img src="{{ asset('uploads/default.png')}}">
    @endif
    
    {!! Form::file('image',['id'=>'pro__pic-upload']) !!}
    
    @if(Session::has('error'))
        <p class="errors text-danger">{!! Session::get('error') !!}</p>
    @endif
    <div id="success"></div>

    <footer class="pro__pic-footer">
        {!! Form::submit('Upload', array('class'=>'btn btn-primary btn-block', 'onclick' => "this.disabled=true;this.value='Sending, please wait...';this.form.submit();" )) !!}
    </footer>
</section>
{!! Form::close() !!}