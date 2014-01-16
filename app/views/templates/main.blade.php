<!DOCTYPE HTML>
<html lang="en" ng-app="amer">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    @if(isset($seo))
        {{ $seo->toHtml() }}
    @else
        <title>Amer Group 2</title>
    @endif

    {{ $template->printAssets('css') }}

</head>
<body>

<div class="container" ng-controller="MainController">

    <div class="header">

        {{ $template->printLocation('header') }}

    </div>



    <div class="body">

        <div class="separator"></div>

        {{ $template->printLocation('upper-body', '<div class="separator"></div>') }}

        <div class="separator"></div>

        <div class="sidebar">

            {{ $template->printLocation('sidebar') }}

        </div>

        <div class="inner-body">

            @if(! $errors->isEmpty())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ implode($errors->all(':message'), '<br/>') }}
            </div>
            @endif

            @if(! $success->isEmpty())
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ implode($success->all(':message'), '<br/>') }}
            </div>
            @endif

            {{ $template->printLocation('inner-body', '<div class="separator"></div>') }}

        </div>
    </div>

    <div class="clearfix"></div>

    <div class="footer">

        {{ $template->printLocation('footer') }}

    </div>
</div>

{{ $template->printAssets('js') }}

</body>
</html>