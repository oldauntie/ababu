@if(session('success'))
<script type="module">
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
<script type="module">
    $(function() {
        toastr.error('{{ session('error') }}')
    })
</script>
@endif


<script>
    setTimeout(function() {
       console.log($);
       // $("#alertbox").alert("test");
    }, 5000);
 </script>