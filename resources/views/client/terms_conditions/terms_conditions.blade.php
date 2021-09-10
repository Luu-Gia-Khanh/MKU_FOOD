@extends('client.layout_client')
@section('content_body')
<link rel="stylesheet" href="{{ asset('public/font_end/custom_ui/css/custom_breadcrumb.css') }}">
<style>
    p {
        text-align: justify;
    }
</style>
<div class="container">
    <nav class="biolife-nav cus_breadcrumb nav-86px">
        <ul>
            <li class="nav-item"><a href="/" class="permal-link">Home</a></li>
            <li class="nav-item"><span class="current-page">Chính sách & điều khoản</span></li>
        </ul>
    </nav>
</div>
<div class="page-contain">
    <div id="main-content" class="main-content">
        <div class="container">
            <p><b>1. Giới thiệu</b><br>

                Chào mừng quý khách hàng đến với MKU FOOD.
                
                Chúng tôi là Công ty Cổ phần Ti Ki có địa chỉ trụ sở tại 29/1 Đường số 4, Khu phố 3, Phường Bình Khánh, Quận 2, Tp.Hồ Chí Minh, địa chỉ giao dịch: 52 Út Tịch, Phường 4, Quận Tân Bình Tp.Hồ Chí Minh, thành lập Sàn giao dịch thương mại điện tử thông qua website www.MKU FOOD.vn và đã được đăng ký chính thức với Bộ Công Thương Việt Nam.
                
                Khi quý khách hàng truy cập vào trang website của chúng tôi có nghĩa là quý khách đồng ý với các điều khoản này. Trang web có quyền thay đổi, chỉnh sửa, thêm hoặc lược bỏ bất kỳ phần nào trong Điều khoản mua bán hàng hóa này, vào bất cứ lúc nào. Các thay đổi có hiệu lực ngay khi được đăng trên trang web mà không cần thông báo trước. Và khi quý khách tiếp tục sử dụng trang web, sau khi các thay đổi về Điều khoản này được đăng tải, có nghĩa là quý khách chấp nhận với những thay đổi đó.
                
                Quý khách hàng vui lòng kiểm tra thường xuyên để cập nhật những thay đổi của chúng tôi.</p>
    
            <p><b>2. Hướng dẫn sử dụng website</b><br>
    
            Khi vào web của chúng tôi, khách hàng phải đảm bảo đủ 18 tuổi, hoặc truy cập dưới sự giám sát của cha mẹ hay người giám hộ hợp pháp. Khách hàng đảm bảo có đầy đủ hành vi dân sự để thực hiện các giao dịch mua bán hàng hóa theo quy định hiện hành của pháp luật Việt Nam.
            
            Chúng tôi sẽ cấp một tài khoản (Account) sử dụng để khách hàng có thể mua sắm trên website MKU FOOD.vn trong khuôn khổ Điều khoản và Điều kiện sử dụng đã đề ra.
            
            Quý khách hàng sẽ phải đăng ký tài khoản với thông tin xác thực về bản thân và phải cập nhật nếu có bất kỳ thay đổi nào. Mỗi người truy cập phải có trách nhiệm với mật khẩu, tài khoản và hoạt động của mình trên web. Hơn nữa, quý khách hàng phải thông báo cho chúng tôi biết khi tài khoản bị truy cập trái phép. Chúng tôi không chịu bất kỳ trách nhiệm nào, dù trực tiếp hay gián tiếp, đối với những thiệt hại hoặc mất mát gây ra do quý khách không tuân thủ quy định.
            
            Nghiêm cấm sử dụng bất kỳ phần nào của trang web này với mục đích thương mại hoặc nhân danh bất kỳ đối tác thứ ba nào nếu không được chúng tôi cho phép bằng văn bản. Nếu vi phạm bất cứ điều nào trong đây, chúng tôi sẽ hủy tài khoản của khách mà không cần báo trước.
            
            Trong suốt quá trình đăng ký, quý khách đồng ý nhận email quảng cáo từ website. Nếu không muốn tiếp tục nhận mail, quý khách có thể từ chối bằng cách nhấp vào đường link ở dưới cùng trong mọi email quảng cáo.</p>
    
    <p><b>3. Ý kiến của khách hàng</b><br>
    
        Tất cả nội dung trang web và ý kiến phê bình của quý khách đều là tài sản của chúng tôi. Nếu chúng tôi phát hiện bất kỳ thông tin giả mạo nào, chúng tôi sẽ khóa tài khoản của quý khách ngay lập tức hoặc áp dụng các biện pháp khác theo quy định của pháp luật Việt Nam.</p>
    
    <p><b>4. Chấp nhận đơn hàng và giá cả</b><br>
    
        Chúng tôi có quyền từ chối hoặc hủy đơn hàng của quý khách vì bất kỳ lý do gì liên quan đến lỗi kỹ thuật, hệ thống một cách khách quan vào bất kỳ lúc nào.
        
        Ngoài ra, để đảm bảo tính công bằng cho khách hàng là người tiêu dùng cuối cùng của MKU FOOD, chúng tôi cũng sẽ từ chối các đơn hàng không nhằm mục đích sử dụng cho cá nhân, mua hàng số lượng nhiều hoặc với mục đích mua đi bán lại.
        
        Chúng tôi cam kết sẽ cung cấp thông tin giá cả chính xác nhất cho người tiêu dùng. Tuy nhiên, đôi lúc vẫn có sai sót xảy ra, ví dụ như trường hợp giá sản phẩm không hiển thị chính xác trên trang web hoặc sai giá, tùy theo từng trường hợp chúng tôi sẽ liên hệ hướng dẫn hoặc thông báo hủy đơn hàng đó cho quý khách. Chúng tôi cũng có quyền từ chối hoặc hủy bỏ bất kỳ đơn hàng nào dù đơn hàng đó đã hay chưa được xác nhận hoặc đã thanh toán.</p>
    
    <p><b>5. Thay đổi hoặc hủy bỏ giao dịch tại MKU FOOD</b><br>
    
        Trong mọi trường hợp, khách hàng đều có quyền chấm dứt giao dịch nếu đã thực hiện các biện pháp sau đây:
        
        Thông báo cho MKU FOOD về việc hủy giao dịch qua đường dây nóng (hotline) 1900-6035 hoặc lời ghi nhắn tại http://hotro.MKU FOOD.vn/hc/vi/requests/new
        Trả lại hàng hoá đã nhận nhưng chưa sử dụng hoặc hưởng bất kỳ lợi ích nào từ hàng hóa đó (theo quy định của chính sách đổi trả hàng tại https://MKU FOOD.vn/doi-tra-de-dang)</p>
    <p><b>6. Giải quyết hậu quả do lỗi nhập sai thông tin tại MKU FOOD</b><br>
    
        Khách hàng có trách nhiệm cung cấp thông tin đầy đủ và chính xác khi tham gia giao dịch tại MKU FOOD. Trong trường hợp khách hàng nhập sai thông tin và gửi vào trang TMĐT MKU FOOD.vn, MKU FOOD có quyền từ chối thực hiện giao dịch. Ngoài ra, trong mọi trường hợp, khách hàng đều có quyền đơn phương chấm dứt giao dịch nếu đã thực hiện các biện pháp sau đây:
        
        Thông báo cho MKU FOOD qua đường dây nóng 1900-6035 hoặc lời nhập nhắn tại địa chỉ http://hotro.MKU FOOD.vn/hc/vi/requests/new
        Trả lại hàng hoá đã nhận nhưng chưa sử dụng hoặc hưởng bất kỳ lợi ích nào từ hàng hóa đó.
        Trong trường hợp sai thông tin phát sinh từ phía MKU FOOD mà MKU FOOD có thể chứng minh đó là lỗi của hệ thống hoặc từ bên thứ ba (sai giá sản phẩm, sai xuất xứ, …), MKU FOOD sẽ đền bù cho khách hàng một mã giảm giá cho các lần mua sắm tiếp theo với mệnh giá tùy từng trường hợp cụ thể và có quyền không thực hiện giao dịch bị lỗi.</p>
    
    <p><b>7. Thương hiệu và bản quyền</b><br>
    
        Mọi quyền sở hữu trí tuệ (đã đăng ký hoặc chưa đăng ký), nội dung thông tin và tất cả các thiết kế, văn bản, đồ họa, phần mềm, hình ảnh, video, âm nhạc, âm thanh, biên dịch phần mềm, mã nguồn và phần mềm cơ bản đều là tài sản của chúng tôi. Toàn bộ nội dung của trang web được bảo vệ bởi luật bản quyền của Việt Nam và các công ước quốc tế. Bản quyền đã được bảo lưu.</p>
    
    <p><b>8. Quyền pháp lý</b><br>
    
        Các điều kiện, điều khoản và nội dung của trang web này được điều chỉnh bởi luật pháp Việt Nam và Tòa án có thẩm quyền tại Việt Nam sẽ giải quyết bất kỳ tranh chấp nào phát sinh từ việc sử dụng trái phép trang web này.</p>
    
    <p><b>9. Quy định về bảo mật</b><br>
    
        Trang web của chúng tôi coi trọng việc bảo mật thông tin và sử dụng các biện pháp tốt nhất bảo vệ thông tin và việc thanh toán của quý khách. Thông tin của quý khách trong quá trình thanh toán sẽ được mã hóa để đảm bảo an toàn. Sau khi quý khách hoàn thành quá trình đặt hàng, quý khách sẽ thoát khỏi chế độ an toàn.
        
        Quý khách không được sử dụng bất kỳ chương trình, công cụ hay hình thức nào khác để can thiệp vào hệ thống hay làm thay đổi cấu trúc dữ liệu. Trang web cũng nghiêm cấm việc phát tán, truyền bá hay cổ vũ cho bất kỳ hoạt động nào nhằm can thiệp, phá hoại hay xâm nhập vào dữ liệu của hệ thống. Cá nhân hay tổ chức vi phạm sẽ bị tước bỏ mọi quyền lợi cũng như sẽ bị truy tố trước pháp luật nếu cần thiết.
        
        Mọi thông tin giao dịch sẽ được bảo mật ngoại trừ trong trường hợp cơ quan pháp luật yêu cầu.
        </p>
    <p><b>10. Thanh toán an toàn và tiện lợi tại MKU FOOD</b><br>
    
        Người mua có thể tham khảo các phương thức thanh toán sau đây và lựa chọn áp dụng phương thức phù hợp:<br>
        
        Cách 1: Thanh toán trực tiếp (người mua nhận hàng tại địa chỉ người bán):<br>
        
        Bước 1: Người mua tìm hiểu thông tin về sản phẩm, dịch vụ được đăng tin;<br>
        
        Bước 2: Người mua đến địa chỉ bán hàng<br>
        
        Bước 3: Người mua thanh toán và nhận hàng;<br>
        
        Cách 2: Thanh toán sau (COD – giao hàng và thu tiền tận nơi):<br>
        
        Bước 1: Người mua tìm hiểu thông tin về sản phẩm, dịch vụ được đăng tin;<br>
        
        Bước 2: Người mua xác thực đơn hàng (điện thoại, tin nhắn, email);<br>
        
        Bước 3: Người bán xác nhận thông tin Người mua;<br>
        
        Bước 4: Người bán chuyển hàng;<br>
        
        Bước 5: Người mua nhận hàng và thanh toán.<br>
        
        Cách 3: Thanh toán online qua thẻ tín dụng, chuyển khoản<br>
        
        Bước 1: Người mua tìm hiểu thông tin về sản phẩm, dịch vụ được đăng tin;<br>
        
        Bước 2: Người mua xác thực đơn hàng (điện thoại, tin nhắn, email);<br>
        
        Bước 3: Người bán xác nhận thông tin Người mua;<br>
        
        Bước 4: Ngưởi mua thanh toán;<br>
        
        Bước 5: Người bán chuyển hàng;<br>
        
        Bước 6: Người mua nhận hàng.<br>
        
        Đối với người mua hàng từ MKU FOOD thì phải tuẩn thu theo chính sách thanh toán của công ty.</p>
    
    <p><b>11. Đảm bảo an toàn giao dịch tại MKU FOOD</b><br>
    
        Chúng tôi sử dụng các dịch vụ để bảo vệ thông tin về nội dung mà người bán đăng sản phẩm trên MKU FOOD. Để đảm bảo các giao dịch được tiến hành thành công, hạn chế tối đa rủi ro có thể phát sinh.</p>
    
    <p><b>12. Luật pháp và thẩm quyền tại Lãnh thổ Việt Nam</b><br>
    
        Tất cả các Điều Khoản và Điều Kiện này và Hợp Đồng (và tất cả nghĩa vụ phát sinh ngoài hợp đồng hoặc có liên quan) sẽ bị chi phối và được hiểu theo luật pháp của Việt Nam. Nếu có tranh chấp phát sinh bởi các Quy định Sử dụng này, quý khách hàng có quyền gửi khiếu nại/khiếu kiện lên Tòa án có thẩm quyền tại Việt Nam để giải quyết.</p>
    
    <p><b>13. Thông tin cá nhân và tính riêng tư</b><br>
    
        Ngoài hệ thống lưu trữ dữ liệu của riêng mình, chúng tôi có thể sử dụng một số dịch vụ của bên thứ 3 để thu thập các thông tin (đã được mã hoá nặc danh) khi bạn sử dụng dịch vụ của MKU FOOD trên MKU FOOD App và Website. Việc thu thập thông tin này giúp chúng tôi cá nhân hoá trải nghiệm của bạn cải tiến dịch vụ của chúng tôi và mang đến những thông điệp quảng cáo phù hợp với nhu cầu mua sắm của bạn. 
         
        Các thông tin thu thập được bạn chủ động gửi cho chúng tôi khi đăng ký tài khoản trên MKU FOOD:
        Tên họ, địa chỉ, số điện thoại, email, ngày sinh, giới tính
        Nhận xét, đánh giá sản phẩm của bạn (bao gồm thông tin chữ, hình, và video do bạn cung cấp)
        Các thông tin đăng ký khác khi bạn chủ động tham gia các chương trình có thu thập thông tin này
        Để sử dụng các tính năng như tìm bằng hình ảnh, chúng tôi cũng dựa vào sự cho phép của bạn khi bạn muốn gửi hình cho chúng tôi
        
        Các thông tin thu thập tự động khi bạn sử dụng dịch vụ của chúng tôi trên MKU FOOD App và Website, ngoài hệ thống lưu trữ riêng, các thông tin này cũng được ghi nhận bởi các dịch vụ truy vấn dữ liệu khác bao gồm Facebook, Google, và Firebase:
        Lịch sử mua hàng
        Lịch sử thao tác người dùng
        Thông tin thanh toán online được bảo mật và ghi nhận bởi các bên dưới đây khi bạn thanh toán trực tuyến trên MKU FOOD App và Website:
        Cybersource: Hệ thống quốc tế về bảo mật thanh toán thẻ tín dụng, ghi nợ (chuẩn PCI DSS)
        Momo & Zalopay: Ví điện tử (chuẩn PCI DSS)</p>
    <p><b>14. Các vấn đề liên quan đến tài khoản:</b><br>
     
        a. Khóa tài khoản/ khóa một phần tính năng của tài khoản; phong tỏa toàn bộ hoặc một phần MKU FOOD xu trên tài khoản của khách hàng trong các trường hợp sau:<br>
         
        - Khi có quyết định hoặc yêu cầu bằng văn bản của cơ quan có thẩm quyền theo quy định của pháp luật.<br>
        - Khi MKU FOOD phát hiện khách hàng có hành vi mua hàng không trung thực điển hình như:<br>
        Có các hành vi không trung thực, lừa đảo.<br>
        
        Tạo đơn hàng ảo hoặc đánh giá ảo.<br>
        Có dấu hiệu lừa đảo hoặc lạm dụng các mã giảm giá và chương trình khuyến mãi.<br>
        Nhà bán hàng tự tạo tài khoản và đặt hàng của chính mình nhằm lợi dụng các chương trình của MKU FOOD.<br>
        Một người dùng tạo nhiều tài khoản để được hưởng nhiều lần đối với một chương trình khuyến mãi của MKU FOOD.<br>
        
        Nhà bán hàng và người mua tự thỏa thuận tăng giá sản phẩm để trục lợi phí vận chuyển, mã giảm giá hoặc lạm dụng các chương trình khuyến mãi khác của MKU FOOD.<br>
        Tách nhỏ đơn hàng số lượng lớn/ mua sỉ thành nhiều đơn nhỏ để lạm dụng chương trình miễn phí vận chuyển của MKU FOOD.<br>
        Các trường hợp khác mà hệ thống của MKU FOOD phát hiện được.<br>
        Nhà bán hàng đặt hộ người mua nhiều lần.<br>
        Khi MKU FOOD nhận được thông báo từ một trong các ngân hàng, khách hàng khác hoặc đối tác của MKU FOOD về việc không trung thực hoặc có bất kì tranh chấp nào liên quan đến tài khoản.<br>
        Các trường hợp khác do Pháp Luật quy định.<br>
        Tùy từng trường hợp, MKU FOOD sẽ có biện pháp xử lý thích hợp, bao gồm khóa tài khoản mà không cần thông báo trước.<br>
         
        b. Tạm khóa hoặc phong tỏa tài khoản sẽ chấm dứt khi có một trong các điều kiện sau:<br>
        - Có văn bản/thông báo từ cơ quan có thẩm quyền về việc tất cả các giao dịch được thực hiện trên tài khoản là hợp pháp hoặc các tranh chấp về Tài Khoản đã được giải quyết hoặc yêu cầu chấm dứt phong tỏa tài khoản.<br>
        - MKU FOOD, sau khi kiểm tra các giấy tờ/thông tin bạn cung cấp chứng minh việc mua hàng (hóa đơn, hình ảnh sản phẩm đã mua,...), sẽ toàn quyền quyết định chấm dứt hoặc tiếp tục việc tạm khóa/ phong tỏa tài khoản.<br>
         
        c. Đóng/khóa tài khoản vĩnh viễn khi:<br>
        -MKU FOOD không nhận được bất kỳ phản hồi nào trong vòng 30 ngày kể từ khi gửi thông báo giới hạn tài khoản.<br>
        - Yêu cầu khôi phục tài khoản của quý khách không được chấp thuận bởi MKU FOOD.<br>
        - Khi tài khoản không hoạt động quá 2 năm.<br>
        - Các trường hợp khác do Pháp Luật quy định.</p>
        </div>
    </div>
</div>

@endsection