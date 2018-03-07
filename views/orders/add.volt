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

                                <input type="hidden" name="order_detail" id="order_detail">
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body">
                        <div class="groupTotal alert m-alert m-alert--default">
                            <table class="table">
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="table tableItems">
                            <div class="pull-left">
                                <h5 class="m-portlet__head-text">
                                    <b>Các Sản phẩm</b>
                                </h5>
                            </div>
                            <div class="pull-right">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#model_discount">
                                    Thêm giảm giá
                                </button>
                                <button type="button" class="btn btn-focus btn-sm" data-toggle="modal" data-target="#model_fee">
                                    Thêm phí
                                </button>

                            </div>
                            <div class="clearfix"></div>
                            <br>

                            <table class="table tableExcel">
                                <thead>
                                <tr>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                                </thead>

                                <tbody id="itemsLine">
                                </tbody>
                            </table>

                            <table class="table tableExcel">
                                <tbody id="">
                                <tr class="rowExcel">
                                    <td colspan="2">
                                        <input type="text" class="js_product_name" placeholder="Tên sản phẩm"></td>
                                    <td width="20%">
                                        <input type="text" class="js_product_price" placeholder="Giá"></td>
                                    <td width="10%">
                                        <input type="number" class="js_product_qty" value="1">
                                        <button
                                                type="button"
                                                class="btn btn-add-row" onclick="order.addProduct(event, '#itemsLine')">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>





    {# POPUP Thêm chi phí #}
    <div class="modal fade" id="model_fee" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Thêm chi phí của đơn hàng
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ formGroupInputVertical('feeplus[value]', {'label': 'Giá trị <sup>(*)</sup>', 'value': '', 'id': 'feeplus_value', 'type': 'number'}) }}
                    {{ formGroupInputVertical('feeplus[note]', {'label': 'Tên chi phí <sup>(*)</sup>', 'value': '', 'id': 'feeplus_note', 'type': 'textarea'}) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng lại
                    </button>
                    <button type="button"
                            data-value="#feeplus_value"
                            data-note="#feeplus_note"
                            data-dismiss="modal"
                            onclick="$(document).trigger('addFee', this)"
                            class="btn btn-success">
                        Thêm phí này.
                    </button>
                </div>
            </div>
        </div>
    </div>
    {# POPUP Thêm chi phí  #}


    {#POP Phí Giảm#}
    <div class="modal fade" id="model_discount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                        Giảm giá đơn hàng này
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ formGroupInputVertical('discount[value]', {'label': 'Giảm', 'value': '', 'id': 'discount_value', 'type': 'number'}) }}
                    {{ formGroupInputVertical('discount[note]', {'label': 'Lý do, Ghi chú', 'value': '', 'id': 'discount_note', 'type': 'textarea'}) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng lại
                    </button>
                    <button type="button" class="btn btn-success"
                            data-value="#discount_value"
                            data-note="#discount_note"
                            data-dismiss="modal"
                            onclick="$(document).trigger('changeDiscount', this)">
                        Lưu thay đổi.
                    </button>
                </div>
            </div>
        </div>
    </div>
    {#POP Phí Giảm#}


    <div style="display: none">
        <table id="temlateItemLine">
            <tbody>
                <tr>
                    <td>
                        {name}
                        <input type="hidden" name="line_item[{index}][name]" value="{name}">
                        <input type="hidden" name="line_item[{index}][price]" value="{price}">
                        <input type="hidden" name="line_item[{index}][qty]" value="{qty}">
                    </td>
                    <td><b>{price_format}</b></td>
                    <td>
                        x {qty}
                    </td>
                    <td>
                        <b class="">{total_format}</b>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>


        var order = {
            itemsline: [],
            total: 0,
            subtotal: 0,
            discount: 0,
            discount_note: '',
            fee_total: 0,
            fee: [],
            selectors: {
                subtotal: $('.js_subtotal .value'),
                discount: $('.js_discount .value'),
                total: $('.js_total .value'),
                tableItem: $('#itemsLine'),
                groupTotal: $('.groupTotal tbody'),
                orderDetail: $('#order_detail')
            },
            template: {
                itemLine: $('#temlateItemLine tbody').html(),
                groupTotal: '<tr><td style="width: 60%" class="text-right">{note}</td><td><b>{value}</b></td></tr>'
            },
            reload: function(){
                this.init();
            },
            resetBeforeReder: function(){
                this.selectors.tableItem.html('');
                this.selectors.groupTotal.html('');
                this.total = this.subtotal = this.fee_total = 0;
            },
            init: function(){
                var that = this;
                that.resetBeforeReder();

                $.each(that.itemsline, function(index, productData){
                    that.selectors.tableItem.prepend(nano(that.template.itemLine, productData));
                    that.subtotal += parseFloat(productData.price * productData.qty);
                });

                if (that.fee.length > 0){
                    $.each(that.fee, function (index, fee) {
                        var value = parseFloat(fee.value);
                        if ( value > 0){
                            that.fee_total += value;
                            order.selectors.groupTotal.append(nano(order.template.groupTotal, {
                                note: fee.note,
                                value: numberFormat.to(fee.value)
                            }))
                        }
                    });
                }

                that.subtotal += that.fee_total;
                order.selectors.groupTotal.append(nano(order.template.groupTotal, {
                    note: '<b>Tạm tính</b>',
                    value: numberFormat.to(that.subtotal)
                }));

                if (that.discount > 0) {
                    order.selectors.groupTotal.append(nano(order.template.groupTotal, {
                        note: '<b>Giảm giá</b><br>' + that.discount_note,
                        value: numberFormat.to( -1 * that.discount)
                    }));
                }

                that.total = that.subtotal - that.discount;
                order.selectors.groupTotal.append(nano(order.template.groupTotal, {
                    note: '<b>Tổng cộng</b>',
                    value: '<b class="priceBig">' + numberFormat.to(that.total) + '</b>'
                }));


                that.bindInput();
            },
            bindInput: function(){
                var that = this;
                that.selectors.orderDetail.val(JSON.stringify({
                    itemsline: that.itemsline,
                    total: that.total,
                    subtotal: that.subtotal,
                    discount: that.discount,
                    discount_note: that.discount_note,
                    fee_total: that.fee_total,
                    fee: that.fee
                }));
            },
            addFee: function(event, el){
                var data = $(el).data();

                if ((typeof  data.value !== 'undefined' && $(data.value).length > 0)
                &&
                    (typeof  data.note !== 'undefined' && $(data.note).length > 0)) {
                    var feeVl = $(data.value).val();
                    feeVl = parseInt(feeVl);
                    if (feeVl > 0 && $(data.note).val() !== '') {
                        order.fee.push({
                            'value': feeVl,
                            'note': $(data.note).val()
                        });
                    }
                }

                this.reload();
            },
            changeDiscount: function(event, el){
                var data = $(el).data();

                if (typeof  data.value !== 'undefined' && $(data.value).length > 0) {
                    var discountVl = $(data.value).val();
                    discountVl = parseFloat(discountVl);
                    order.discount = discountVl;
                    order.discount_note = $(data.note).val();
                }

                this.reload();
            },
            addProduct: function(event, tbody){
                var d = new Date();

                var $tr = $(event.target).closest('tr');
                var productData = {
                    'name': $.trim($tr.find('.js_product_name').val()),
                    'price': parseFloat($tr.find('.js_product_price').val()),
                    'qty': parseInt($tr.find('.js_product_qty').val())
                };

                if (productData.name === '' || productData.price === '') {
                    return false;
                }

                if (productData.price > 0){
                    productData.total = productData.price * productData.qty
                }

                productData.index = d.getTime();
                productData.price_format = numberFormat.to(productData.price);
                productData.total_format = numberFormat.to(productData.total);

                order.itemsline.push(productData);

                $tr.find('.js_product_name').val('').focus();
                $tr.find('.js_product_price').val(0);
                $tr.find('.js_product_qty').val(1);

                $(document).trigger('refreshTotal');
            }
        };

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