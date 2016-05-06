<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WSO2 Official Docker Repositories</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<header class="navbar navbar-fixed-top">
    <div class="container">
        <div class="pull-left brand float-remove-xs text-center-xs">
            <a href="#">
                <img src="/images/logo.svg" alt="wso2" title="wso2" class="logo">
                <h1 class="display-block-xs">WSO2 Docker Repositories</h1>
            </a>
        </div>
        <div class="pull-right brand col-md-5">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." id="search">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search!</button>
                  </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </div>
</header>

<div class="container">

    <div class="starter-template">
        <h1>Explore Repositories</h1>
    </div>
    <div class="row select-blocks">
        <ul class="block-no-bulet col-md-12">

        </ul>
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.block-no-bulet').html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw margin-bottom"></i>');
        var text = '';
        $.getJSON( "http://registry_url/repo.php", function( data ) {
           var repositories = data.repositories;
            for (i = 0; i < repositories.length; i++) {

            text += '<li class="block-main">' +
                        '<a class="block-flex" href="tags.php?repo='+repositories[i]+'">' +
                        '<div class="block-one block-general" >' +
                        '<div class="block-title" >' +
                        '<div class="block-labels" >' +
                        '<div class="block-title-one" >'+repositories[i]+'</div>' +
                        '<span class="block-title-two" ></span>' +
                        '</div></div></div>' +
                       // '<div class="block-two block-general" >' +
                       // '<div class="" ><div class="" >2.7K</div><div class="" >STARS</div></div></div>' +
                       // '<div class="block-three block-general" ><div class="" ><div class="" >10M+</div><div class="" >PULLS</div>' +
                        '</div></div>' +
                        '<div class="block-four block-general" ><i class="fa fa-chevron-right fa-lg" ></i><div class="text">DETAILS</div>' +
                        '</div>' +
                        '</a>' +
                        '</li>';
            }
            $('.block-no-bulet').html('');
            $('.block-no-bulet').append(text);
        });


    });

    $("#search").on("keyup paste", function() {
        var value = $(this).val().toUpperCase();
        var $rows = $(".block-main");

        if(value === ''){
            $rows.fadeIn(300);
            return false;
        }

        $rows.each(function(index) {
            if (index !== 1) {

                $row = $(this);

                var column1 = $row.find(".block-title-one").html().toUpperCase();

                if (column1.indexOf(value) > -1) {
                    $row.fadeIn(300);
                }
                else {
                    $row.fadeOut(300);
                }
            }
        });
    });
</script>
</body>
</html>
