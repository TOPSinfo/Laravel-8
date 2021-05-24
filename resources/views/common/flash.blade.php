{{--@if (session('success'))--}}
{{--    @include('alerts.success')--}}
{{--@endif--}}
{{--@if (session('error'))--}}
{{--    @include('alerts.error')--}}
{{--@endif--}}
{{--@if (session('info'))--}}
{{--    @include('alerts.info')--}}
{{--@endif--}}
{{--@if (session('warning'))--}}
{{--    @include('alerts.warning')--}}
{{--@endif--}}

@push('js')
<script>
@if(session('success'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
toastr.success("{{ session('success') }}");
@endif

@if(session('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
toastr.error("{{ session('error') }}");
@endif

@if(session('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
toastr.info("{{ session('info') }}");
@endif

@if(session('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
toastr.warning("{{ session('warning') }}");
@endif
</script>
@endpush