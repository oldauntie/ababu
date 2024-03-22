@if(session('success'))
<script type="text/javascript">
    $(function() {
        toastr.success('{{ session('success') }}')
    })
</script>
@endif