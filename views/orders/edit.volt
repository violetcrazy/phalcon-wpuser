{% extends 'main_layout.volt' %}

{% block content %}

    <form action="" class="formMain" method="post">
        <div class="m-portlet--head-solid-bg m-portlet m-portlet--mobile m-portlet--{{ template.getColorStatusOrder(orderDetail.status) }}">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">

                        <h3 class="m-portlet__head-text">
                            Chi tiết đơn hàng #{{ orderDetail.order_id }}
                            <small>
                                <b>IP: </b>{{ orderDetail.getIp() }}
                            </small>
                        </h3>

                    </div>
                    <div>
                        <b class="m--icon-font-size-lg1">{{ util.currencyFormat(orderDetail.total_price) }}</b>
                        <span class="m--icon-font-size-sm2"> - Thanh toán tiền mặt khi nhận đuược hàng</span>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <select onchange="form.submit()" class="form-control m-input m-input--square" id="" name="order_status">
                        {{ template.optionsStatusOrder(orderDetail.status) }}
                    </select>
                </div>

            </div>
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group m-form__group">
                            <label class="col-form-label">
                                Người phụ trách
                            </label>
                            <div class="">
                                <select class="form-control selectCskh" id="" name="param">
                                    <option></option>
                                </select>
                            </div>
                        </div>

                        <h5><b>Người mua</b></h5>
                        {{ formGroupText('billing[name]', {'label': 'Họ & tên', 'value': orderDetail.getBilling('name'), 'id': 'user_name'}) }}
                        {{ formGroupText('billing[phone]', {'label': 'Điện thoại', 'value': orderDetail.getBilling('phone'), 'id': 'user_phone'}) }}
                        {{ formGroupText('billing[email]', {'label': 'Email', 'value': orderDetail.getBilling('email'), 'id': 'user_email'}) }}
                        {{ formGroupText('billing[address]', {'label': 'Địa chỉ', 'value': orderDetail.getBilling('address'), 'id': 'user_address'}) }}

                        <h5 class=""><b>Người nhận</b></h5>
                        {{ formGroupText('shipping[name]', {'label': 'Họ & tên', 'value': orderDetail.getShipping('name'), 'id': 'user_name'}) }}
                        {{ formGroupText('shipping[phone]', {'label': 'Điện thoại', 'value': orderDetail.getShipping('phone'), 'id': 'user_phone'}) }}
                        {{ formGroupText('shipping[email]', {'label': 'Email', 'value': orderDetail.getShipping('email'), 'id': 'user_email'}) }}
                        {{ formGroupText('shipping[address]', {'label': 'Địa chỉ', 'value': orderDetail.getShipping('address'), 'id': 'user_address'}) }}
                    </div>

                    <div class="col-lg-7">
                        {% include 'orders/__table_product.volt' %}
                    </div>
                </div>
            </div>

            <div class="m-form m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions m-form__actions text-right">
                    <button type="submit" class="btn btn-lg btn-success" style="width: 200px;">
                        Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </form>

    <form action="" onsubmit="order.saveNote(event, '{{ url.get({'for': 'order_addnote_ajax'}) }}')">
        <div class="m-portlet m-portlet--full-height " id="formNote">

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Ghi chú đơn hàng
                        </h3>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">

                <div class="form-group m-form__group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <label class="m-checkbox m-checkbox--single">
                                    <input type="checkbox" name="note_type" value="on">
                                    <span></span>
                                </label>
                            </span>
                            <span class="input-group-text" id="basic-addon1">
                                Chung
                            </span>
                        </div>

                        <input type="text" class="form-control" placeholder="Ghi chú đơn hàng" name="note_content">
                        <input type="hidden" name="order_id" value="{{ orderDetail.order_id }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary loading-click" type="submit" data-target="#formNote">
                                Thêm ghi chú
                            </button>
                        </div>
                    </div>
                </div>

                <div class="m-widget3" id="orderNotes">

                </div>
            </div>
        </div>
    </form>



    {% include 'orders/__popup_template.volt' %}

    <script src="{{ url.get() }}/assets/js/add_order.js"></script>
    <script>
        $(document).ready(function(){
            order.itemsline = {{ orderDetail.getItems('JSON') }};
            order.discount = '{{ orderDetail.get_meta('discount') }}';
            order.discount_note = '{{ orderDetail.get_meta('discount_note') }}';
            order.fee = {{ orderDetail.get_meta('fee_plus')|json_encode }};
            order.init();

            $(document).trigger('loadNotes');
        });
        $(document).on('loadNotes', function(event, el){
            $('#orderNotes').load('{{ url.get({'for': 'order_notes_ajax'}) }}?order_id={{ orderDetail.order_id }}');
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


{% block content_right %}
    <div class="row">
        <h4>Ghi chú đơn hàng</h4>

        <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
            <div class="m-messenger__messages">
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--in">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-username">
                                    Megan wrote
                                </div>
                                <div class="m-messenger__message-text">
                                    Hi Bob. What time will be the meeting ?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--out">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-text">
                                    Hi Megan. It's at 2.30PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--in">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-username">
                                    Megan wrote
                                </div>
                                <div class="m-messenger__message-text">
                                    Will the development team be joining ?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--out">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-text">
                                    Yes sure. I invited them as well
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--in">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-username">
                                    Megan wrote
                                </div>
                                <div class="m-messenger__message-text">
                                    Noted. For the Coca-Cola Mobile App project as well ?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--out">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-text">
                                    Yes, sure.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--out">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-text">
                                    Please also prepare the quotation for the Loop CRM project as well.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--in">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-username">
                                    Megan wrote
                                </div>
                                <div class="m-messenger__message-text">
                                    Noted. I will prepare it.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--out">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-text">
                                    Thanks Megan. I will see you later.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-messenger__wrapper">
                    <div class="m-messenger__message m-messenger__message--in">
                        <div class="m-messenger__message-body">
                            <div class="m-messenger__message-arrow"></div>
                            <div class="m-messenger__message-content">
                                <div class="m-messenger__message-username">
                                    Megan wrote
                                </div>
                                <div class="m-messenger__message-text">
                                    Sure. See you in the meeting soon.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-messenger__seperator"></div>
            <div class="m-messenger__form">
                <div class="m-messenger__form-controls">
                    <input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
                </div>
                <div class="m-messenger__form-tools">
                    <a href="" class="m-messenger__form-attachment">
                        <i class="la la-paperclip"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
