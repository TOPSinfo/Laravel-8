$(document).ready(function() {
    // Delete Record in listing Page
    $('.select_all').on('click', function(e) {
        $('input[name="row_id"]').prop('checked', $(this).prop('checked')).trigger('change');
    });
});
window.onload = function () {
    // Bulk delete selectors
    var $bulkDeleteBtn = $('#bulk_delete_btn');
    var $bulkDeleteModal = $('#bulk_delete_modal');
    var $bulkDeleteCount = $('#bulk_delete_count');
    var $bulkDeleteDisplayName = $('#bulk_delete_display_name');
    var $bulkDeleteInput = $('#bulk_delete_input');
    // Reposition modal to prevent z-index issues
    $bulkDeleteModal.appendTo('body');
    // Bulk delete listener
    $bulkDeleteBtn.click(function () {
        var ids = [];
        var $checkedBoxes = $('#dataTable input[type=checkbox]:checked').not('.select_all');
        var count = $checkedBoxes.length;
        if (count) {
            // Reset input value
            $bulkDeleteInput.val('');
            // Deletion info
            var displayName = count > 1 ? double : single;
            displayName = displayName.toLowerCase();
            $bulkDeleteCount.html(count);
            $bulkDeleteDisplayName.html(displayName);
            // Gather IDs

            console.log($checkedBoxes);

            $.each($checkedBoxes, function () {
                var value = $(this).val();
                ids.push(value);
            })
            // Set input value
            $bulkDeleteInput.val(ids);
            // Show modal
            $bulkDeleteModal.modal('show');
        } else {
            // No row selected
            toastr.warning('You haven&#039;t selected anything to delete');
        }
    });
}