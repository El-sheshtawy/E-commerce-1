@include('site.admin.layouts.styles')
<div class="container-scroller">
@include('site.admin.layouts.sidebar')
<div>
@include('site.admin.layouts.nav')
        @yield('content')
</div>
</div>
@include('site.admin.layouts.scripts')
@include('site.admin.layouts.footer')




