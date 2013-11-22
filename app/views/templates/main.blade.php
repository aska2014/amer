<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amer group</title>

    {{ $template->printAssets('css') }}

</head>
<body>

<div class="container">

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