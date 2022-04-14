$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
});

function removeRow(id, url) {
    if (confirm('Xóa mà không thể khôi phục. Bạn có chắc?')) {
        $.ajax({
            type: 'DELETE',
            dataType: 'json',
            data: {id},
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}

/** upload file */
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'json',
        data: form,
        url: '/admin/upload/services',
        success: function (result) {
            if (result.error === false) {
                $("#image_show").html('<a href="' + result.url + '" target="_blank">' + '<img src="' + result.url + '" width="100px"></a>');

                $('#file').val(result.url);
            } else {
                alert('Upload File lỗi');
            }
        }
    })
})