  //select edit data 
  $(document).ready(function() {
    $('#inputAnggotaKeluarga').on('show.bs.modal', function(e) {
        var idx = $(e.relatedTarget).data('id');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: 'reload/inputAnggotaKeluarga.php',
            data: 'idx=' + idx,
            success: function(data) {
                $('.data-penduduk-kk').html(data); //menampilkan data ke dalam modal
            }
        });
    });
});
//end select data 
