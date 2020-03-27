<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="/css/pannellum.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/jquery.pano.js"></script>
    <script src="/js/pannellum.js"></script>
</head>
<body>
    <div class="embed object">
        <div class="row">
            <div id="tour" class="clearfix col s12">
                <div id="pano"></div>
            </div>
        </div>
        <script>
            @include('catalog.pano_js')
        </script>
    </div>
</body>