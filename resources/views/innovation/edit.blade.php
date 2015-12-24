@extends('layout')

@section('content')

<script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector : ".with-wysiwyg",
//        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
//        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ",
        toolbar : "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ",
    });
</script>

<div class="container">

    <!--Alert for successfully submitted innovation -->
    @if(Session::has('flash_message'))

    <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {{ session('flash_message') }}

    </div>

    @endif



    <!-- This div has been left out to avoid repetition -->
    <!--<div class="step__feedback msg__box">
		Project created successfully.
	</div>-->

    <!-- Alert for errors in innovation submission form -->
    @if (count($errors) > 0)
    <div class="alert alert-danger" role="alert" >
        <h5>Oh snap! <b>Change a few things up</b> and try submitting again!</h5>
    </div>
    @endif

    <form class="innoNew" action="{{ url('innovation/update/'.$innovation->id) }}" method="post">

        {!! csrf_field() !!}
        {!! $errors->first('innovationTitle', '<label class="help-block">:message</label>' ) !!}
        <header class="innoDetails__header">
            <input type="text" name="innovationTitle" class="inno-title" value="{{ $innovation->innovationTitle }}">
            <button type="button" class="cta cta__btn cta__create">
                @if (count($errors) > 0)
                Edit Innovation
                @else
                Update
                @endif
            </button>
        </header>

        <div class="step__2">
            <section class="innoDetails__content">
                <fieldset name="personal" class="form__cluster">
                    <div class="form-group">
                        <div class="form__field">
                            <label>Short Summary</label>
                            {!! $errors->first('innovationShortDescription', '<label class="help-block">:message</label>' ) !!}
                            <textarea class="form-control" name="innovationShortDescription">{{ $innovation->innovationShortDescription }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label>Detailed Summary</label>
                            {!! $errors->first('innovationDescription', '<label class="help-block">:message</label>' ) !!}
                            <div class="form-control">
                                <textarea class="with-wysiwyg" name="innovationDescription">{{ $innovation->innovationDescription }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label>Field</label>
                            {!! $errors->first('innovationCategory', '<label class="help-block">:message</label>' ) !!}
                            <select name="innovationCategory" class="form-control">
                                <option disabled selected>Uncategorized</option>

                                @if($categories->count())
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if ($innovation->category_id == $category->id)  selected="selected" @endif>{{ $category->categoryName }}</option>
                                @endforeach
                                @else
                                <option value="" disabled selected>No listed categories here</option>
                                @endif
                            </select>

                        </div>
                        <div class="form__field">
                            <label>Trademark Name(if any)</label>
                            {!! $errors->first('tradeMarkName', '<label class="help-block">:message</label>' ) !!}
                            <input type="name" name="tradeMarkName" value="{{ $innovation->tradeMarkName }}" class="form-control">
                        </div>
                        <div class="form__field">
                            <label>Trademark Registration Number(if any)</label>
                            {!! $errors->first('tradeMarkNumber', '<label class="help-block">:message</label>' ) !!}
                            <input type="name" name="tradeMarkNumber" value="{{ $innovation->tradeMarkNumber }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label for="">How much do you need?</label>
                            {!! $errors->first('innovationFund', '<label class="help-block">:message</label>' ) !!}
                            <input type="name" name="innovationFund" class="form-control" value="{{ $innovation->innovationFund }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field">
                            <label>What's the funding for?</label>
                            {!! $errors->first('justifyFund', '<label class="help-block">:message</label>' ) !!}
                            <textarea class="form-control" name="justifyFund" rows="5" >{{ $innovation->justifyFund }}</textarea>
                        </div>
                    </div>
                </fieldset>
            </section>

            <footer class="innoDetails__footer">
                <div class="pull-right">
                    <button type="submit"  class="cta cta__btn cta__publish" id="btnADD" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Update</button>
                </div>
            </footer>
        </div>
    </form>
</div> <!-- end container -->



@stop