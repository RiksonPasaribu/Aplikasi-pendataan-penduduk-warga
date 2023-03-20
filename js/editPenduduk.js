  //select edit data 
  $(document).ready(function() {
    $('#editPenduduk').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: 'reload/data_penduduk.php',
            data: 'idx=' + idx,
            success: function(data) {
                $('.data-penduduk').html(data); //menampilkan data ke dalam modal
            }
        });
    });
});
//end select data 
