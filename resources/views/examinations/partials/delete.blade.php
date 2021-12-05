<form id="examination-edit-delete-form" method="POST" action="">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>