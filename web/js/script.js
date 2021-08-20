$('#table-data').on('click', '.tr_clone_add', function () {
    var $tr = $(this).closest('.tr_clone');
    var $clone = $tr.clone();
    $clone.find(':text').val('');
    $tr.after($clone);
});