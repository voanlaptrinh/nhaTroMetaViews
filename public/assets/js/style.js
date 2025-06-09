$(document).ready(function() {
    $('.select_ted').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: "-- Vui lòng chọn --",
        allowClear: true
    });
});
toastr.options = {
    "progressBar": true, // Hiển thị thanh tiến trình
    "timeOut": 2000, // Thời gian hiển thị thông báo (2 giây)
    "extendedTimeOut": 1000, // Thời gian hiển thị khi người dùng di chuột vào thông báo (1 giây)

};
