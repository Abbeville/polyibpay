<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content/>
    <meta name="author" content/>
    <title>BillsPay</title>
    @include('landingpage.partials.css')
</head>
<body>
<div id="layoutDefault">
    <div id="layoutDefault_content">
        <main>

            @include('landingpage.partials.nav')
            @include('landingpage.partials.hero')
            @yield('content')

        </main>
    </div>
    <div id="layoutDefault_footer">

        @include('landingpage.partials.footer')

    </div>
</div>

@include('landingpage.partials.scripts')


</body>
</html>
