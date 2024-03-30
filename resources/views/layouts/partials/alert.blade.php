<script type="module">
    $(function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "timeOut": "10000",
        };
    })
    @if (session('success'))
        $(function() {
            toastr.success('{{ session('success') }}')
        })
    @endif

    @if (session('info'))
        $(function() {
            toastr.info('{{ session('info') }}')
        })
    @endif

    @if (session('warning'))
        $(function() {
            toastr.warning('{{ session('warning') }}')
        })
    @endif

    @if (session('error'))
        $(function() {
            toastr.error('{{ session('error') }}');
        })
    @endif
</script>
