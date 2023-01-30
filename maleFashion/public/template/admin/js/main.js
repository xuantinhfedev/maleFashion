$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
