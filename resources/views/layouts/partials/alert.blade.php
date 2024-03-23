@if(session('success'))
<script type="text/javascript">
    $(function() {
        toastr.success('{{ session('success') }}')
    })
</script>
@endif

@if(session('info'))
<script type="text/javascript">
    $(function() {
        toastr.info('{{ session('info') }}')
    })
</script>
@endif

@if(session('warning'))
<script type="text/javascript">
    $(function() {
        toastr.warning('{{ session('warning') }}')
    })
</script>
@endif

@if(session('error'))
<script type="text/javascript">
    $(function() {
        toastr.error('{{ session('error') }}')
    })
</script>
@endif