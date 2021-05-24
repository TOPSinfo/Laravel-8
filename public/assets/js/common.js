$(document).ready(function() {
    // Delete Record in listing Page
    $(document).on("click", ".delete_data",function(e){
        e.preventDefault();
        var form_id = $(this).attr('data-href');
        $(".btn-delete").attr('id',form_id);
    });

    // Submit form based on form id
    $(document).on("click", ".btn-delete",function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $("#delete_"+id).click();
    });

});
