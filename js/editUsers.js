  //select edit data 
  $(document).ready(function() {
    $('#editUsers').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: 'reload/dataUsers.php',
            data: 'idx=' + idx,
            success: function(data) {
                $('.data-users').html(data); //menampilkan data ke dalam modal
            }
        });
    });
});
//end select data 
