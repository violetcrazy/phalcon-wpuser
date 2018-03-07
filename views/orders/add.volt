{% extends 'main_layout.volt' %}

{% block content %}

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
                    {{ formGroupInputGroup2Text('coupon', {'label': 'Mã giảm giá', 'value': '', 'id': 'coupon', 'label_after': '- 0 đ'}) }}

                    <div class="groupTotal alert m-alert m-alert--default">
                        <p class="text-right js_subtotal">
                            <b>Tổng cộng</b>
                            <span class="value">0</span><sup>đ</sup>
                        </p>

                        <p class="text-right js_discount">
                            <a href="javascript:;" data-toggle="modal" data-target="#model_discount">Edit</a> <b>Giảm giá</b>
                            <span class="value">0</span><sup>đ</sup>
                        </p>

                        <p class="text-right js_total">
                            <b>Thanh toán</b>
                            <span class="value priceBig">0</span><sup>đ</sup>
                        </p>

                    </div>

                    <div class="table tableItems">
                        <div class="pull-left">
                            <h5 class="m-portlet__head-text">
                                <b>Các Sản phẩm</b>
                            </h5>
                        </div>
                        <div class="pull-right">
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
                                <tr class="rowExcel">
                                    <td colspan="2">
                                        <input type="text" class="js_product_name" placeholder="Tên sản phẩm"></td>
                                    <td width="20%">
                                        <input type="text" class="js_product_price" placeholder="Giá"></td>
                                    <td width="10%">
                                        <input type="number" class="js_product_qty" value="1">
                                        <button class="btn btn-add-row" onclick="order.addProduct(event, '#itemsLine')">
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
                    {{ formGroupInputVertical('feeplus[value]', {'label': 'Giá trị', 'value': '', 'id': 'feeplus_value', 'type': 'number'}) }}
                    {{ formGroupInputVertical('feeplus[note]', {'label': 'Tên chi phí', 'value': '', 'id': 'feeplus_note', 'type': 'textarea'}) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng lại
                    </button>
                    <button type="button" class="btn btn-success">
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
                    <button type="button" class="btn btn-success">
                        Lưu thay đổi.
                    </button>
                </div>
            </div>
        </div>
    </div>
    {#POP Phí Giảm#}


    {#POP Thêm Sản phẩm#}
    <div class="modal fade" id="model_addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">
                        Thêm sản phẩm
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ formGroupInputVertical('addproduct[name]', {'label': 'Tên sản phẩm ', 'value': '', 'id': 'addproduct_name', 'type': 'text'}) }}
                    {{ formGroupInputVertical('addproduct[image]', {'label': 'Hình ảnh (url)', 'value': '', 'id': 'addproduct_image', 'type': 'text'}) }}
                    {{ formGroupInputVertical('addproduct[price]', {'label': 'Giá', 'value': '', 'id': 'addproduct_price', 'type': 'number'}) }}
                    {{ formGroupInputVertical('addproduct[qty]', {'label': 'Số lượng', 'value': '', 'id': 'addproduct_qty', 'type': 'number'}) }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Đóng lại
                    </button>
                    <button type="button" class="btn btn-success">
                        Thêm sản phẩm.
                    </button>
                </div>
            </div>
        </div>
    </div>
    {#POP Thêm Sản phẩm#}

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
            itempline: {}
        };

        order.addProduct = function(event, tbody){
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

            order.itempline[productData.index] = productData;

            var htmlTemplate = $('#temlateItemLine tbody').html();
            $(tbody).prepend(nano(htmlTemplate, productData));

            $tr.find('.js_product_name').val('').focus();
            $tr.find('.js_product_price').val(0);
            $tr.find('.js_product_qty').val(1);

            $(document).trigger('refreshTotal');
        };

        $(document).on('refreshTotal', function(){

        });

        $(document).on('input', '#coupon', function(){
            $(document).trigger('updateCoupon')
        });


    </script>
{% endblock %}