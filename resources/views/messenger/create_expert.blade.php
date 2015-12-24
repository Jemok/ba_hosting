<div class="container">
    <h5>Chat with an Expert:</h5>
    {!! Form::open(['route' => 'messages.store']) !!}

    <input type="hidden" name="innovation_id" value="{{$innovation->id}}">
    <div class="col-md-6">
        <!-- Subject Form Input -->
        <div class="form-group">
            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>



        <select id="select2" name="recipients[]" class="form-control">
            <option disabled selected>Select Expert</option>

            @if($users->count())
            @foreach($users as $user)
            <option value="{!!$user->id!!}" @if (old('recipients[]') == $user->first_name)  selected="selected" @endif>{{ $user->first_name }}</option>
            @endforeach
            @else
            <option value="" disabled selected>No Experts found</option>
            @endif
        </select>


        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>

