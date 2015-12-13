<script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
    tinymce.init({
        selector : "textarea.yes",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ",
    });
</script>

<!--Alert for successfully submitted innovation -->
<div class="col-lg-12">

    <div class="container">
        @if(Session::has('flash_message'))

        <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
            @if(Session::has('flash_message_important'))

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

            @endif

            {{ session('flash_message') }}

        </div>

        @endif
    </div>

    <!-- This div has been left out to avoid repetition -->
    <!--<div class="step__feedback msg__box">
		Project created successfully.
	</div>-->

    <!-- Alert for errors in innovation submission form -->
    @if (count($errors) > 0)
    <div class="alert alert-danger" role="alert" >
        <h5>Oh snap! <b>Change a few things up</b> and try submitting again!</h5>

        @foreach ($errors->all() as $message)


        <li>{{ $message }}</li>


        @endforeach



    </div>
    @endif

    <form class="innoNew" action="{{ url('create/innovation') }}" method="post">

        {!! csrf_field() !!}
        <header class="innoDetails__header">
            <input type="text" name="innovationTitle" placeholder="Your innovation title" class="inno-title" value="{{ old('innovationTitle') }}">
            <button type="button" class="cta cta__btn cta__create">Create</button>
        </header>

        <div class="step__2">
            <section class="innoDetails__content">
                <!--<textarea class="inno-summary" name="innovationDescription" rows="5" placeholder="Tell us about your something about that idea...">//{{ old('innovationDescription') }}</textarea>-->
                <textarea class="yes" name="innovationDescription"></textarea>
            </section>
            <footer class="innoDetails__footer">
                <div class="pull-left">
                    Filed under
                    <select name="innovationCategory" class="inno-category">

                        <option value="{{ old('innovationTitle') }}" disabled selected>Uncategorized</option>

                        @if($categories->count())

                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                        @endforeach

                        @else

                        <option value="" disabled selected>No listed categories here</option>

                        @endif


                    </select>
                </div>
                <div class="pull-right">
                    <a href="#" class="cta cta__prev cta__link">&larr; Back</a>
                    <button type="button" class="cta cta__next cta__btn">Step 3 of 3: Enter funding details</button>
                </div>
            </footer>
        </div>

        <div class="step__3">
            <footer class="innoDetails__footer">
                <div class="pull-left">
                    <input type="name" name="innovationFund" placeholder="Ksh. 1,000,000" value="{{ old('innovationFund') }}">
                </div>
                <div>
                    <textarea class="inno-summary" name="justifyFund" rows="5" placeholder="Whats the money for?">{{ old('justifyFund') }}</textarea>
                </div>
                <div>
                    <input type="name" name="tradeMarkName" placeholder="Trademark Name" value="{{ old('tradeMarkName') }}">
                    <input type="name" name="tradeMarkNumber" placeholder="Registration Number" value="{{ old('tradeMarkNumber') }}">
                </div>
                <div class="pull-right">
                    <button type="submit" class="cta cta__btn cta__publish">Publish</button>
                </div>
            </footer>
        </div>
    </form>
</div> <!-- end col-lg-9 -->

<div class="row innovation-pane">
    <div class="col-lg-12">
        <nav class="innoFilters">
            <button class="filter current" data-filter="*">Show all</button>
            @if($categories->count())

            @foreach($categories as $category)
            <button class="filter" data-filter=".{{ $category->categoryName }}">{{ $category->categoryName }}</button>
            @endforeach

            @endif
        </nav>
    </div>

    <div class="col-lg-9">
        @include('partials.innovations.open')
    </div>

    <aside class="col-lg-3">
        @include('partials.innovations.funded')
    </aside>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>
