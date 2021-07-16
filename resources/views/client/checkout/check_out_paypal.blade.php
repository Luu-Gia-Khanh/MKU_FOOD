<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="form_paypal" method="post">

            <input type="hidden" name="business" value="sb-8vpav6055059@business.example.com">

            <!-- tham số cmd có giá trị _xclick chỉ rõ cho paypal biết là người dùng nhất nút thanh toán -->
            <input type="hidden" name="cmd" value="_xclick">

            <!-- thông tin mua hàng -->
            <input type="hidden" name="item_name" value="HoaDonMuaHang">

             <input type="hidden" name="amount" placeholder="Nhập số tiền vào"
            value="{{ $vnd_to_usd }}">

            <!-- loại tiền -->
            <input type="hidden" name="currency_code" value="USD">

            <input type="hidden" name="return" value="http://luugiakhanh.com/Laravel_CuaHangDoChoiTreEm/history_order">

            <input type="hidden" name="cancel_return" value="">

            <input type="submit" id="papal_click" name="submit" style="opacity: 0">
        </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#papal_click').click();
        });
    </script>
</body>
</html>
