<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Official Docker Repositories - Tags</title>

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
            <a href="index.php">
                <img src="/images/logo.svg" alt="wso2" title="wso2" class="logo">
                <h1 class="display-block-xs">WSO2 Docker Repositories</h1>
            </a>
        </div>
    </div>
</header>

<div class="container">

    <div class="starter-template">
        <h1>Repository name: <?php echo $_GET['repo']; ?></h1>
        <p class="lead">
            <pre>docker pull docker_registry.com/<?php echo $_GET['repo']; ?></pre>
        </p>
    </div>
    <div class="row starter-template">
        <table class="table table-striped">
           <thead>
               <tr>
                   <td>Tags</td>
               </tr>
           </thead>
            <tbody class="tag-container">

            </tbody>
        </table>
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
        var getTagName = getParameterByName('repo');
        var text = '';
        $.getJSON( "http://docker_registry_url/tag.php?repo="+getTagName, function( data ) {
            var repositories = data.tags;
            for (i = 0; i < repositories.length; i++) {
            text += '<tr><td>docker_registry.com/'+getTagName + ':<strong>'+repositories[i]+'</strong><a class="docker-delete pull-right" href="#"> Delete </a></td></tr>';
            }
            $('.tag-container').append(text);
        });


    });


    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)", "i"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

</script>
</body>
</html>
