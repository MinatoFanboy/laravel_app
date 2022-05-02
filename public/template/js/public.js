function loadMore() {
    const page = $('#page').val();
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        data: {
            page: $('#page').val(),
            _token: $('input[name="_token"]').val(),
        },
        url: '/services/load-product',
        success: function (data) {
            if (data.html) {
                $('#loadProduct').append(data.html);
                $('#page').val(paserInt(page) + 1);
            } else {
                alert('Đã load xong sản phẩm');
                $('#button-loadMore').css('display', 'none');
            }
        }
    })
}