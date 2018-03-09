<input type="hidden" id="order_detail" name="order_detail">
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
            <th></th>
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
                <input type="text" class="js_product_price formatCurrency" placeholder="Giá"></td>
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



<div style="display: none">
    <table id="temlateItemLine">
        <tbody>
        <tr>
            <td>
                <b>{name}</b>
                <input type="hidden" name="line_item[{index}][name]" value="{name}">
                <input type="hidden" name="line_item[{index}][price]" value="{price}">
                <input type="hidden" name="line_item[{index}][qty]" value="{qty}">
            </td>
            <td><b>{price_format}</b></td>
            <td>
                x {qty}
                <div class="noenter">
                    <button type="button" class="btn btn-metal btn-xs" onclick="order.changeQty(event, '{index}', '-')">Trừ</button>
                    <button type="button" class="btn btn-warning btn-xs" onclick="order.changeQty(event, '{index}', '+')">Cộng</button>
                </div>
            </td>
            <td>
                <b class="">{total_format}</b>
            </td>
            <td width="1%">
                <button class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill"
                        onclick="order.deleteItem(event, '{index}')"
                        type="button"
                        title="Delete">
                    <i class="la la-close"></i>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</div>