(function (e) {
    'use strict';

    // Target textareas with specific class or name attributes
    $('textarea[data-summernote]').each(function() {
        var $this = $(this);
        if (!$this.hasClass('note-editable')) {
            $this.summernote({
                height: 120,
            });
        }
    });

    // Also initialize on the original #summernote element for backward compatibility
    if ($('#summernote').length && !$('#summernote').hasClass('note-editable')) {
        $('#summernote').summernote({
            height: 120,
        });
    }
})();
