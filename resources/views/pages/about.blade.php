<!-- Displays the Bongo Afrika about page -->

@extends('layout')

@section('content')

<div class="__section with-columns equally-split fill-page without-moving">
    <section class="__column __left h-centered">
        <div class="contain-this">
			<div class="__content-block m-b-lg">
				<h3 class="section__title">What we do</h3>
				<p>We seek to bring balance in the entrepreneurial ecosystem that is taking wild turns daily at the expense of innovators who mostly find themselves on the losing end. Bongo Afrika creates an enabling environment for startups and innovators to pitch to investors for seed stage investment capital. Provides innovators with legal assistance, mentorship and advice in forging business relationships with investors. The community allows for both investors and innovators to also interact with experts in their respective fields.</p>
			</div>

            <div class="__section with-columns">
				<section class="__column h-centered">
					<div class="__content-block">
						<h4 class="section__title">Our mission</h4>
						<p>To reach out to young entrepreneurs from all over Africa and provide them with equal opportunity to build on their dreams by providing affordable legal assistance and helping them forge professional relationships with investors and experts in their respective fields.</p>
					</div>
					<div class="__content-block">
						<h4 class="section__title">Our vision</h4>
						<p>To make Africa a safe haven for young entrepreneurs from all industries and grow the African economy through generational wealth. We have the capacity within ourselves.</p>
					</div>
				</section>
				<section class="__column h-centered">
					<div class="__content-block m-b-lg">
						<h3 class="section__title">Bongo afrika offers..</h3>
						<ol>
							<li>Protection of innovators from exploitation by unethical investors.</li>
							<li>A digital footprint of one’s intellectual work</li>
							<li>A platform for innovators and investors to interact on a one on one basis and foster professional relations.</li>
							<li>Allow for potential employers scout for employees.</li>
							<li>Provide the youth a platform to showcase their works, talent and even solutions on current issues affecting africa.</li>
						</ol>
					</div>
           		</section>
            </div>
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