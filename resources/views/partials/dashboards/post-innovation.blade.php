<html>
<head>
    <meta charset="UTF-8">
    <title>Post-Innovation</title>

    <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Bitter:700,400,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}">

</head>

<body>

<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="title-pane">
                <h1>Creative Name for my Innovation</h1>
            </div> <!-- end title-pane -->
        </div>

        <div class="row write-innovation" id="row-Text">
            <div class="col-lg-12">
                <textarea class="write-innovation__text" placeholder="Write a creative description">
                </textarea>

                <div class="dropdown write-innovation__category">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Category
                        <span class="caret"></span>
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">Education</a></li>
                        <li><a href="#">Agriculture</a></li>
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Medicine</a></li>
                    </ul>
                </div>

                <div class="btn btn-link write-innovation__cta">
                    <a href="post-innovation-funding.html">
                        Next Funding Details
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div> <!-- end write-innovation -->

        <div class="innovations-pane">
            <div class="row row-Innovation">
                <div class="col-lg-6 six">
                    <h4> <a href=""  class="innovation-title">Creative name for the Innovation</a></h4>
                    <h5><a href="">Category</a></h5>
                    <p class="innovation-p">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.
                    </p>
                </div> <!-- end col-lg-6 -->

                <div class="col-lg-6 six">
                    <h4><a href=""  class="innovation-title"> Creative name for the Innovation</a></h4>
                    <h5><a href="">Category</a></h5>
                    <p class="innovation-p">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat.
                    </p>
                </div> <!-- end col-lg-6 -->
            </div> <!-- end row-Innovationn -->
        </div> <!-- end innovations-pane -->

    </div> <!-- end col-lg-9 -->

    <div class="col-lg-3">

        <div class="advert well"></div>
        <hr />
        <div class="funded-projects">
            <h2>Funded Projects</h2>

            <a href="">Lorem ipsum dolor sit amet,consectetur adipiscing elit.</a>
            <h5>Category</h5>

            <hr />
            <a href="">Lorem ipsum dolor sit amet,consectetur adipiscing elit.</a>
            <h5>Category</h5>

            <hr />
            <a href="">Lorem ipsum dolor sit amet,consectetur adipiscing elit.</a>
            <h5>Category</h5>


        </div>

    </div> <!-- end col-lg-3 -->

</div> <!-- end Row -->


<!-- compiled and minified javascript -->
<script src="{{ asset('/js/jquery.min.js') }}"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>

</body>
</html>