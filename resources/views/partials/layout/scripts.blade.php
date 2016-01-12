<!-- compiled and minified javascript -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>

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
