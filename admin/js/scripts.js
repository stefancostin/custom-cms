// Tiny MCE initialization
tinymce.init({ selector: 'textarea' });

$(document).ready(function() {
    // Select All / Deselect All Checkbox on Posts Table
    $('#selectAllBoxes').click(function(event) {
        if(this.checked) {
            $('.checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    // Alert interaction
    $('.pull-right.has-pointer').click(function() {
        $('.alert').addClass('d-none');
    });
});