<div class="col-lg-12">
    <div class="innoData-grid">
        <div class="innoData">
            <div class="innoData__title">Funding Available (Ksh.)</div>
            <div class="innoData__content">71,000,500</div>
        </div>
        <div class="innoData">
            <div class="innoData__title">Funding Injected (Ksh.)</div>
            <div class="innoData__content">9,999,500</div>
        </div>
        <div class="innoData">
            <div class="innoData__title">Projects Funded</div>
            <div class="innoData__content">51</div>
        </div>
        <div class="innoData">
            <div class="innoData__title">In Progress</div>
            <div class="innoData__content">153</div>
        </div>
    </div>
</div> <!-- end col-lg-9 -->

<div class="row innovation-pane">
    <div class="col-lg-12">
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
    </div>

    <div class="col-lg-9">
        @include('partials.innovations.open')
    </div>

    <aside class="col-lg-3">
        @include('partials.innovations.funded')
    </aside>
</div>