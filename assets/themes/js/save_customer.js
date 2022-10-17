$(document).ready(function () {

    const Messages = {
        '1': "Thông tin khách hàng đã được lưu thành công vào quản lý khách hàng của bạn.",
        '2': "Khách hàng không đủ điều kiện để lưu thông tin",
        '4': "Khách hàng này đã được lưu vào quản lý khách hàng của bạn.",
        '5': "Đã hết phiên làm việc",
        '': "Hệ thống xảy ra vấn đề. Bạn vui lòng quay lại sau."
    }

    $(document).on('click', '#save_customer_check_cic', function () {
        var btn = this;
        var textResult = $.trim($('#result').text());
        if (textResult != '') {
            if (textResult.toLowerCase().indexOf('tên khách hàng') >= 0) {
                btn.style.background = "#5fffa5";

                var cmnd = $.trim($('#cmnd').val());
                $.post(link_save_customer_check_cic, { cmnd: cmnd }, function (data) {
                    setTimeout(function () {
                        btn.style.background = "none";
                    }, 1000);

                    var n = data.split(";;;");

                    if (n[0] in Object.keys(Messages)) {
                        if (n[0] == '1') {
                            toastr.success(Messages[n[0]]);
                        } else {
                            toastr.error(Messages[n[0]]);
                        }

                    } else {
                        toastr.success(Messages[""]);
                    }

                });
            } else {
                toastr.error("Khách hàng không đủ điều kiện để lưu thông tin");
            }
        } else {
            toastr.error("Bạn chưa check CIC. Vui lòng check");
        }
    });

    $(document).on('click', '#save_customer_check_cic_lock', function () {
        alert('Tài khoản chưa hỗ trợ chức năng Lưu thông tin');
    });
});
