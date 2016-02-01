<!-- Displays the Bongo Afrika about page -->
@extends('layout')

@section('content')

<div class="__section with-columns equally-split">
    <section class="__column __left h-centered">
        <div class="contain-this">
            <div class="__content-block m-b-lg" style="margin-top: 30px;">
                <h3 class="section__title">Website usage terms and conditions </h3>

                <p>Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern Bongo Afrika’s relationship with you in relation to this website. If you disagree with any part of these terms and conditions, please do not use our website.
                The term Bongo Afrika or ‘us’ or ‘we’ refers to the owner(s) of the website.
                </p>

                <p> The term ‘you’ refers to the user or viewer of our website.</p>

                <p>The use of this website is subject to the following terms of use:</p>
                <ul>
                    <li>
                        The content of the pages of this website is for your general information and use only. It is subject to change without notice.
                    </li>
                    <li>
                        This website uses cookies to monitor browsing preferences.
                    </li>
                    <li>
                        Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.
                    </li>
                    <li>
                        Your use of any information or materials on this website without author 's consent is at your own risk, for which legal action might be taken against you.
                    </li>
                    <li>
                        It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.
                    </li>
                    <li>
                        This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.
                    </li>
                    <li>
                        All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.
                    </li>
                    <li>
                        Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.
                    </li>
                    <li>
                        From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).
                    </li>
                </ul>
            </div>


    </section>
    <!--
        <section class="__column __right h-centered with-background" style="background-image: url('{{ asset('/img/covers/innovation-1.jpg') }}')">
            <div class="__content-block">

            </div>
        </section>
    -->
</div>
@stop

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $('div.alert-message').not('.alert-important').delay(2000).slideUp(300);
</script>