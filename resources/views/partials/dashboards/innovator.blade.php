<!-- The innovator dashboard partial -->

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
        
    <form class="innoNew" action="{{ route('createInnovation') }}" method="post">

        {!! csrf_field() !!}
        {!! $errors->first('innovationTitle', '<label class="help-block">:message</label>' ) !!}
        <header class="innoDetails__header">
            <input type="text" name="innovationTitle" placeholder="Your innovation title" class="inno-title" value="{{ old('innovationTitle') }}">
            <button type="button" class="cta cta__btn cta__create">
            @if (count($errors) > 0)
                Edit Innovation
            @else
                Create
            @endif
            </button>
        </header>

        <div class="step__2">
            <section class="innoDetails__content">
                <fieldset name="personal" class="form__cluster">
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('innovationShortDescription') ? 'has-error' : ''}}">
                            <label>Short Summary</label>
                            {!! $errors->first('innovationShortDescription', '<label class="help-block">:message</label>' ) !!}
                            <textarea class="form-control" name="innovationShortDescription" placeholder="In one paragraph tell us, what's this innovation about?">{{old('innovationShortDescription')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('innovationDescription') ? 'has-error' : ''}}">
                            <label>Detailed Summary</label>
                            {!! $errors->first('innovationDescription', '<label class="help-block">:message</label>' ) !!}
                            <div class="form-control">
                                <textarea class="with-wysiwyg" name="innovationDescription" placeholder="Tell us more about your innovation">{{old('innovationDescription')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('innovationCategory') ? 'has-error' : ''}}">
                            <label>Field</label>
                            {!! $errors->first('innovationCategory', '<label class="help-block">:message</label>' ) !!}
                            <select name="innovationCategory" class="form-control">
                                <option disabled selected>Uncategorized</option>

                                @if($categories->count())
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('innovationCategory') == $category->id)  selected="selected" @endif>{{ $category->categoryName }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>No listed categories here</option>
                                @endif
                            </select>
                        </div>
                        <div class="form__field {{ $errors->has('tradeMarkName') ? 'has-error' : ''}}">
                            <label>Trademark Name(if any)</label>
                            {!! $errors->first('tradeMarkName', '<label class="help-block">:message</label>' ) !!}
                            <input type="name" name="tradeMarkName" placeholder="Trademark Name" value="{{ old('tradeMarkName') }}" class="form-control">
                        </div>
                        <div class="form__field {{ $errors->has('tradeMarkNumber') ? 'has-error' : ''}}">
                            <label>Trademark Registration Number(if any)</label>
                            {!! $errors->first('tradeMarkNumber', '<label class="help-block">:message</label>' ) !!}
                            <input type="name" name="tradeMarkNumber" placeholder="Registration Number" value="{{ old('tradeMarkNumber') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('innovationFund') ? 'has-error' : ''}}">
                            <label for="">How much do you need?</label>
                            {!! $errors->first('innovationFund', '<label class="help-block">:message</label>' ) !!}
                            <input type="name" name="innovationFund" placeholder="Ksh. 1,000,000" class="form-control" value="{{ old('innovationFund') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__field {{ $errors->has('justifyFund') ? 'has-error' : ''}}">
                            <label>What's the funding for?</label>
                            {!! $errors->first('justifyFund', '<label class="help-block">:message</label>' ) !!}
                            <textarea class="form-control" name="justifyFund" rows="5" placeholder="Whats the money for?">{{ old('justifyFund') }}</textarea>
                        </div>
                    </div>
                </fieldset>
            </section>
            
            <footer class="innoDetails__footer">
                <div class="pull-right">
                    <button type="submit"  class="cta cta__btn cta__publish" id="btnADD" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Publish</button>
                </div>
            </footer>
        </div>
    </form>
</div> <!-- end container -->

<div class="container">
    <nav class="innoFilters">
        <button class="filter current" data-filter="*">Show all</button>
        @if($categories->count())

        @foreach($categories as $category)
        <button class="filter" data-filter=".{{ $category->categoryName }}">{{ $category->categoryName }}</button>
        @endforeach

        @endif
    </nav>
    
    <section class="row">
        <div class="col-lg-9">
            @include('partials.innovations.open')
        </div>

        <aside class="col-lg-3">
            @include('partials.innovations.funded')
        </aside>
    </section>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>


