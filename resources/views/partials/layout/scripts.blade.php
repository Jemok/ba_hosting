<!-- Handles all the js scripts -->

<!-- compiled and minified javascript -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('js/jquery.uploadPreview.min.js') }}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/slick.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

<!-- Start Messenger Demo Changes -->
<script src="{{ asset('/js/all.js') }}" type="text/javascript"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        }
    });
</script>


<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);

    var $myForm = $("#my_form");
    $myForm.submit(function(){
        $myForm.submit(function(){
            return false;
        });
    });
</script>


