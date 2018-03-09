{% extends 'main_layout.volt' %}

{% block content %}
    <form action="" class="formMain" method="post">
        <div class="actionButton">
            <button class="btn btn-success">Lưu đơn hàng</button>
        </div>
        <hr>
        <div class="row">


            <div class="col-lg-5">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Thông tin người mua hàng
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body ">
                        <h5><b>Người mua</b></h5>
                        {{ formGroupText('billing[name]', {'label': 'Họ & tên', 'value': '', 'id': 'user_name'}) }}
                        {{ formGroupText('billing[phone]', {'label': 'Điện thoại', 'value': '', 'id': 'user_phone'}) }}
                        {{ formGroupText('billing[email]', {'label': 'Email', 'value': '', 'id': 'user_email'}) }}
                        {{ formGroupText('billing[address]', {'label': 'Địa chỉ', 'value': '', 'id': 'user_address'}) }}
                    </div>

                    <div class="m-portlet__body">
                        <h5><b>Người nhận (nếu có)</b> </h5>
                        {{ formGroupText('shipping[name]', {'label': 'Họ & tên', 'value': '', 'id': 'user_name'}) }}
                        {{ formGroupText('shipping[phone]', {'label': 'Điện thoại', 'value': '', 'id': 'user_phone'}) }}
                        {{ formGroupText('shipping[email]', {'label': 'Email', 'value': '', 'id': 'user_email'}) }}
                        {{ formGroupText('shipping[address]', {'label': 'Địa chỉ', 'value': '', 'id': 'user_address'}) }}
                    </div>
                </div>
            </div>


            <div class="col-lg-7">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Sản phẩm
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body">
                       {% include 'orders/__table_product.volt' %}
                    </div>
                </div>
            </div>
        </div>
    </form>



    {% include 'orders/__popup_template.volt' %}

    <script src="{{ url.get() }}/assets/js/add_order.js"></script>
    <script>
        $(document).ready(function(){
            order.init();
        });
        $(document).on('addFee', function(event, el){
            order.addFee(event, el);
        });
        $(document).on('changeDiscount', function(event, el){
            order.changeDiscount(event, el);
        });
        $(document).on('refreshTotal', function(){
            order.reload();
        });
        $(document).on('input', '#coupon', function(){
            $(document).trigger('updateCoupon')
        });
    </script>
{% endblock %}