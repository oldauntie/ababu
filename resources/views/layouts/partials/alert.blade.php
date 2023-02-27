@if(session('success'))
<script type="text/javascript">
    $(function() {
        toastr.info('Are you the 6 fingered man?')
    })
</script>
@endif