@include('layouts.header')
<main id="wrapper" onclick="hideMenu()">
    <div class="main">
        @yield("content")
    </div>
</main>
@include('layouts.footer')
