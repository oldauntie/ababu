    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="modalTextInput form-control" placeholder="Text Here" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary saveEdit">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script type="module">
        $(function() {
            $('#exampleModal').on('show.bs.modal', function(e) {
                $('.modalTextInput').val('');
                let btn = $(e
                    .relatedTarget
                    ); // e.related here is the element that opened the modal, specifically the row button
                let id = btn.data('id'); // this is how you get the of any `data` attribute of an element
                console.log('raised show.bs.modal event from button with data-id=' + id);

                return;

                // nanna(id);

                $.ajax({
                    url: "http://localhost/clinics/68e8ffd5-7dc6-4c8a-a9b7-d7e78df8e3bb/prescriptions/f841c6a2-ecf9-4a96-aa5d-e8b46285c54f/get",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        console.log(res);
                        alert(res);
                    }
                });

                let text = $('.modalTextInput').val(id);
                $('.saveEdit').data('id', id); // then pass it to the button inside the modal
            })

            $('.saveEdit').on('click', function() {
                let id = $(this).data('id'); // the rest is just the same
                saveNote(id);
                // $('#exampleModal').modal('toggle'); // this is to close the modal after clicking the modal button
            })
        })

        function saveNote(id) {
            let text = $('.modalTextInput').val();
            $('.recentNote').data('note', text);
            console.log($('.recentNote').data('note'));
            console.log(text + ' --> ' + id);
        }
    </script>
