<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials._head')
    </head>

    <body>
        <!-- nav section -->
        @include('partials._nav')

        <!-- main content -->
        <div class="container">
            @include('partials._message')

            <!-- page specific content -->
            @yield('content')

            <!-- footer -->
            @include('partials._footer')
        </div>

        <!-- javascript files -->
        @include('partials._javascript')
    </body>
</html>