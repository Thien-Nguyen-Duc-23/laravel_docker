$(document).ready( function() {
    CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: '/admin/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: '/admin/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: '/admin/ckfinder.html?type=Flash',
        filebrowserUploadUrl: '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: '/admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
})
