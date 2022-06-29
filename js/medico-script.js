$(document).ready(function () {
    $("#newsticker").jCarouselLite({
        vertical: true,
        hoverPause: true,
        btnPrev: "#news-prev",
        btnNext: "#news-next",
        visible: 3,
        auto:3000,
        speed:500

    });

    loadcart();
    
    $("#style-grid").click(function ()
    {
        $("#block-product-list").hide();
        $("#block-product-grid").show();

        $("#style-grid").attr("src","/images/icon-grid-active.png")
        $("#style-list").attr("src","/images/icon-list.png")

        $.cookie('select_style', 'grid');
    });

    $("#style-list").click(function ()
    {
        $("#block-product-grid").hide();
        $("#block-product-list").show();

        $("#style-list").attr("src","/images/icon-list-active.png")
        $("#style-grid").attr("src","/images/icon-grid.png")

        $.cookie('select_style', 'list');
    });
    if ($.cookie('select_style') == 'grid')
    {
        $("#block-product-list").hide();
        $("#block-product-grid").show();
        $("#style-grid").attr("src", "/images/icon-grid-active.png")
        $("#style-list").attr("src", "/images/icon-list.png")
    }
    else
    {
        $("#block-product-grid").hide();
        $("#block-product-list").show();
        $("#style-list").attr("src","/images/icon-list-active.png")
        $("#style-grid").attr("src","/images/icon-grid.png")
    }

    $("#select-sort").click(function () {
       $("#sorting-list").slideToggle(200);
    });

    $('#block-categories > ul > li > a').click(function(){
        if ($(this).attr('class') != 'active'){

            $('#block-categories > ul > li > ul').slideUp(400);
            $(this).next().slideToggle(400);

            $('#block-categories > ul > li > a').removeClass('active');
            $(this).addClass('active');
            $.cookie('select_cat', $(this).attr('id'));
        }else
        {
             $('#block-categories > ul > li > a').removeClass('active');
             $('#block-categories > ul > li > ul').slideUp(400);
             $.cookie('select_cat', '');
        }

    });

    if ($.cookie('select_cat') != '');
    {
        $('#block-categories > ul > li > #'+$.cookie('select_cat')).addClass('active').next().show();
    }

    $('#simptom-list > ul > li > a').click(function(){
        if ($(this).attr('class') != 'active'){

            $('#simptom-list > ul > li > ul').slideUp(400);
            $(this).next().slideToggle(400);

            $('#simptom-list > ul > li > a').removeClass('active');
            $(this).addClass('active');
            $.cookie('select_cat', $(this).attr('id'));
        }else
        {
            $('#simptom-list > ul > li > a').removeClass('active');
            $('#simptom-list > ul > li > ul').slideUp(400);
            $.cookie('select_cat', '');
        }

    });

    if ($.cookie('select_cat') != '');
    {
        $('#simptom-list > ul > li > #'+$.cookie('select_cat')).addClass('active').next().show();
    }

    $('#genpass').click(function() {
        $.ajax({
            type: "POST",
            url: "/functions/genpass.php",
            dataType: "html",
            cache: false,
            success: function (data) {
                $('#reg_pass').val(data);
            }
        });
    });
    
    $('.top-auth').toggle(
        function () {
            $(".top-auth").attr("id", "active-button");
            $("#block-top-auth").fadeIn(200);
        },
        function () {
            $(".top-auth").attr("id", "");
            $("#block-top-auth").fadeOut(200);
        }
    );

    $('#button-pass-show-hide').click(function(){
        var statuspass = $('#button-pass-show-hide').attr("class");

        if (statuspass == "pass-show")
        {
            $('#button-pass-show-hide').attr("class","pass-hide");

            var $input = $("#auth_pass");
            var change = "text";
            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                .attr("id", $input.attr("id"))
                .attr("name", $input.attr("name"))
                .attr('class', $input.attr('class'))
                .val($input.val())
                .insertBefore($input);
            $input.remove();
            $input = rep;

        }else
        {
            $('#button-pass-show-hide').attr("class","pass-show");

            var $input = $("#auth_pass");
            var change = "password";
            var rep = $("<input placeholder='Пароль' type='" + change + "' />")
                .attr("id", $input.attr("id"))
                .attr("name", $input.attr("name"))
                .attr('class', $input.attr('class'))
                .val($input.val())
                .insertBefore($input);
            $input.remove();
            $input = rep;

        }

    });

    $("#button-auth").click(function() {

        var auth_login = $("#auth_login").val();
        var auth_pass = $("#auth_pass").val();


        if (auth_login == "" || auth_login.length > 30 )
        {
            $("#auth_login").css("borderColor","#FDB6B6");
            send_login = 'no';
        }else {

            $("#auth_login").css("borderColor","#DBDBDB");
            send_login = 'yes';
        }


        if (auth_pass == "" || auth_pass.length > 15 )
        {
            $("#auth_pass").css("borderColor","#FDB6B6");
            send_pass = 'no';
        }else { $("#auth_pass").css("borderColor","#DBDBDB");  send_pass = 'yes'; }



        if ($("#rememberme").prop('checked'))
        {
            auth_rememberme = 'yes';

        }else { auth_rememberme = 'no'; }


        if ( send_login == 'yes' && send_pass == 'yes' )
        {
            $("#button-auth").hide();
            $(".auth-loading").show();

            $.ajax({
                type: "POST",
                url: "/include/auth.php",
                data: "login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
                dataType: "html",
                cache: false,
                success: function(data) {

                    if (data == 'yes_auth')
                    {
                        location.reload();
                    }else
                    {
                        $("#message-auth").slideDown(400);
                        $(".auth-loading").hide();
                        $("#button-auth").show();
                    }

                }
            });
        }
    });

    $('#auth-user-info').toggle(
        function() {
            $("#block-user").fadeIn(100);
        },
        function() {
            $("#block-user").fadeOut(100);
        }
    );

    $('#logout').click(function(){

        $.ajax({
            type: "POST",
            url: "/include/logout.php",
            dataType: "html",
            cache: false,
            success: function(data) {

                if (data == 'logout')
                {
                    location.reload();
                }

            }
        });
    });

    $('#input-search').bind('textchange', function () {

        var input_search = $("#input-search").val();

        if (input_search.length >= 3 && input_search.length < 150 )
        {
            $.ajax({
                type: "POST",
                url: "/include/search.php",
                data: "text="+input_search,
                dataType: "html",
                cache: false,
                success: function(data) {

                    if (data > '')
                    {
                        $("#result-search").show().html(data);
                    }else{

                        $("#result-search").hide();
                    }

                }
            });

        }else
        {
            $("#result-search").hide();
        }

    });

    // Шаблон перевірки email на справжність
    function isValidEmailAddress(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }
    // Контактні дані
    $('#confirm-button-next').click(function(e){

        var order_fio = $("#order_fio").val();
        var order_email = $("#order_email").val();
        var order_phone = $("#order_phone").val();
        var order_address = $("#order_address").val();

        if (!$(".order_delivery").is(":checked"))
        {
            $(".label_delivery").css("color","#E07B7B");
            send_order_delivery = '0';

        }else { $(".label_delivery").css("color","black"); send_order_delivery = '1';


            // Перевірка ПІБ
            if (order_fio == "" || order_fio.length > 50 )
            {
                $("#order_fio").css("borderColor","#FDB6B6");
                send_order_fio = '0';

            }else { $("#order_fio").css("borderColor","#DBDBDB");  send_order_fio = '1';}


            // Перевірка email
            if (isValidEmailAddress(order_email) == false)
            {
                $("#order_email").css("borderColor","#FDB6B6");
                send_order_email = '0';
            }else { $("#order_email").css("borderColor","#DBDBDB"); send_order_email = '1';}

            // Перевірка телефону

            if (order_phone == "" || order_phone.length > 50)
            {
                $("#order_phone").css("borderColor","#FDB6B6");
                send_order_phone = '0';
            }else { $("#order_phone").css("borderColor","#DBDBDB"); send_order_phone = '1';}

            // Перевірка адреси

            if (order_address == "" || order_address.length > 150)
            {
                $("#order_address").css("borderColor","#FDB6B6");
                send_order_address = '0';
            }else { $("#order_address").css("borderColor","#DBDBDB"); send_order_address = '1';}

        }
        // Глобальна перевірка
        if (send_order_delivery == "1" && send_order_fio == "1" && send_order_email == "1" && send_order_phone == "1" && send_order_address == "1")
        {
            // Відправлення форми
            return true;
        }

        e.preventDefault();

    });

    $('.add-cart-style-list,.add-cart-style-grid,.add-cart').click(function(){

        var  tid = $(this).attr("tid");

        $.ajax({
            type: "POST",
            url: "include/addtocart.php",
            data: "id="+tid,
            dataType: "html",
            cache: false,
            success: function(data) {
                loadcart();
            }
        });

    });

    function loadcart(){
        $.ajax({
            type: "POST",
            url: "/include/loadcart.php",
            dataType: "html",
            cache: false,
            success: function(data) {

                if (data == "0")
                {

                    $("#block-basket > a").html("Кошик порожній");

                }else
                {
                    $("#block-basket > a").html(data);

                }

            }
        });

    }

    $('.count-minus').click(function(){

        var iid = $(this).attr("iid");

        $.ajax({
            type: "POST",
            url: "/include/count-minus.php",
            data: "id="+iid,
            dataType: "html",
            cache: false,
            success: function(data) {
                $("#input-id"+iid).val(data);
                loadcart();

                // Змінна з ціною продукта
                var priceproduct = $("#tovar"+iid+" > p").attr("price");
                // Множення ціни на кількість
                result_total = Number(priceproduct) * Number(data);

                $("#tovar"+iid+" > p").html(result_total+" грн");
                $("#tovar"+iid+" > h5 > .span-count").html(data);

                itog_price();
            }
        });

    });

    $('.count-plus').click(function(){

        var iid = $(this).attr("iid");

        $.ajax({
            type: "POST",
            url: "/include/count-plus.php",
            data: "id="+iid,
            dataType: "html",
            cache: false,
            success: function(data) {
                $("#input-id"+iid).val(data);
                loadcart();

                // Змінна з ціною продукта
                var priceproduct = $("#tovar"+iid+" > p").attr("price");
                // Множення ціни на кількість
                result_total = Number(priceproduct) * Number(data);

                $("#tovar"+iid+" > p").html(result_total+" грн");
                $("#tovar"+iid+" > h5 > .span-count").html(data);

                itog_price();
            }
        });

    });

    $('.count-input').keypress(function(e){

        if(e.keyCode==13){

            var iid = $(this).attr("iid");
            var incount = $("#input-id"+iid).val();

            $.ajax({
                type: "POST",
                url: "/include/count-input.php",
                data: "id="+iid+"&count="+incount,
                dataType: "html",
                cache: false,
                success: function(data) {
                    $("#input-id"+iid).val(data);
                    loadcart();

                    // Змінна з ціною продукта
                    var priceproduct = $("#tovar"+iid+" > p").attr("price");
                    // Множення ціни на кількість
                    result_total = Number(priceproduct) * Number(data);


                    $("#tovar"+iid+" > p").html(result_total+" грн");
                    $("#tovar"+iid+" > h5 > .span-count").html(data);
                    itog_price();

                }
            });
        }
    });

    function  itog_price(){

        $.ajax({
            type: "POST",
            url: "/include/itog_price.php",
            dataType: "html",
            cache: false,
            success: function(data) {

                $(".itog-price > strong").html(data);

            }
        });

    }

    $('#button-send-review').click(function(){

        var name = $("#name_review").val();
        var good = $("#good_review").val();
        var bad = $("#bad_review").val();
        var comment = $("#comment_review").val();
        var iid = $("#button-send-review").attr("iid");

        if (name != "")
        {
            name_review = '1';
            $("#name_review").css("borderColor","#DBDBDB");
        }else {
            name_review = '0';
            $("#name_review").css("borderColor","#FDB6B6");
        }

        if (good != "")
        {
            good_review = '1';
            $("#good_review").css("borderColor","#DBDBDB");
        }else {
            good_review = '0';
            $("#good_review").css("borderColor","#FDB6B6");
        }

        if (bad != "")
        {
            bad_review = '1';
            $("#bad_review").css("borderColor","#DBDBDB");
        }else {
            bad_review = '0';
            $("#bad_review").css("borderColor","#FDB6B6");
        }


        // Глобальна перевірка та відправка відгуку

        if ( name_review == '1' && good_review == '1' && bad_review == '1')
        {
            $("#button-send-review").hide();
            $("#reload-img").show();

            $.ajax({
                type: "POST",
                url: "/include/add_review.php",
                data: "id="+iid+"&name="+name+"&good="+good+"&bad="+bad+"&comment="+comment,
                dataType: "html",
                cache: false,
                success: function() {
                    setTimeout("$.fancybox.close()", 1000);
                }
            });
        }
    });

});