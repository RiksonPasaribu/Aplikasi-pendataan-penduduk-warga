  //select edit data 
  $(document).ready(function() {
    $('#editLingkungan').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: 'reload/dataLingkungan.php',
            data: 'idx=' + idx,
            success: function(data) {
                $('.data-lingkungan').html(data); //menampilkan data ke dalam modal
            }
        });
    });
});
//end select data 
