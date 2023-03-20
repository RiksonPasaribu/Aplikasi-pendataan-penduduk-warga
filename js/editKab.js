  //select edit data 
  $(document).ready(function() {
    $('#editKab').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: 'reload/data_kabupaten.php',
            data: 'idx=' + idx,
            success: function(data) {
                $('.data-kabupaten').html(data); //menampilkan data ke dalam modal
            }
        });
    });
});
//end select data 
