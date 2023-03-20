  //select edit data 
  $(document).ready(function() {
    $('#pindah').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: 'reload/data_pindah.php',
            data: 'idx=' + idx,
            success: function(data) {
                $('.data-penduduk-pindah').html(data); //menampilkan data ke dalam modal
            }
        });
    });
});
//end select data 
