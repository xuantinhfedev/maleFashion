// Thiết lập AJAX
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Hàm xóa menu sử dụng AJAX
function removeRow(id, url){
    if(confirm('Bản ghi sẽ xóa mất. Bạn có tiếp tục?')){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function(result){
                // console.log("Kết quả nhận được: ", result);
                if(result.error === false){
                    alert(result.message);
                    location.reload();
                } else{
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}



// Upload file
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results) {
            if(results.error == false){
                $('#image_show').html('<a href="' + results.url + '" target="_blank"> <img src="' + results.url + '"  width="100px"/></a>');

                $('#thumb').val(results.url);
            }else{
                 alert('Upload File lỗi');
            }

        }
    });
})
