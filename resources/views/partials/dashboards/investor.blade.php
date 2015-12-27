<div class="container">
    @if(Session::has('flash_message'))

    <div class="alert-message alert alert-success {{ Session::has('flash_message_important') ? 'alert-important' : '' }}">
        @if(Session::has('flash_message_important'))

        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        @endif

        {{ session('flash_message') }}

    </div>

    @endif
    
    <div class="innoData-grid">
        <div class="innoData">
            <div class="innoData__title">Funding Available (Ksh.)</div>
            <div class="innoData__content">{{ \Auth::user()->investor_amount }}</div>
        </div>
        <div class="innoData">
            <div class="innoData__title">Funding Injected (Ksh.)</div>
            <a href="{{route('investorFundedInnovations')}}"><div class="innoData__content">{{$totalFundsInjected}}</div></a>
        </div>

        <div class="innoData">
            <div class="innoData__title">Projects Funded</div>
            <a href="{{route('investorFundedInnovations')}}"><div class="innoData__content">{{$fundedProjectsCount}}</div></a>
        </div>

        <div class="innoData">
            <div class="innoData__title">In Progress</div>
            <div class="innoData__content">{{$onProgress}}</div>
        </div>
    </div>

    <div class="row">
        <nav class="innoFilters">
            <button class="filter current" data-filter="*">Show all</button>
            <button class="filter" data-filter=".art">Art</button>
            <button class="filter" data-filter=".crafts">Crafts</button>
            <button class="filter" data-filter=".dance">Dance</button>
            <button class="filter" data-filter=".design">Design</button>
            <button class="filter" data-filter=".education">Education</button>
            <button class="filter" data-filter=".fashion">Fashion</button>
            <button class="filter" data-filter=".film">Film & Video</button>
            <button class="filter" data-filter=".food">Food</button>
            <button class="filter" data-filter=".games">Games</button>
            <button class="filter" data-filter=".journalism">Journalism</button>
            <button class="filter" data-filter=".music">Music</button>
            <button class="filter" data-filter=".photography">Photography</button>
            <button class="filter" data-filter=".technology">Technology</button>
        </nav>

        <div class="col-lg-9">
            @include('partials.innovations.open')
        </div>

        <aside class="col-lg-3">
            @include('partials.innovations.funded')
        </aside>
    </div>
</div> <!-- end container -->