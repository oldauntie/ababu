<form id="pet-edit-delete-form" method="POST" action="clinics/{[$clinic->id]}/pets/{pet}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>