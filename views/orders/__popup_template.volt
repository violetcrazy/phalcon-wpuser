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

                <div class="feePlusList" id="feePlusList">
                    <table class="table table-bordered">

                    </table>
                </div>
                <table class="table tableExcel">
                    <tbody id="">
                    <tr class="rowExcel">
                        <td colspan="2">
                            <input type="text" class="js_fee_name" placeholder="Tên, ghi chú khoản phí"></td>
                        <td width="20%">
                            <input type="text" class="formatCurrency js_fee_price" placeholder="Giá trị"></td>
                        <td width="10%">
                            <button type="button"
                                    class="btn btn-add-row"
                                    data-note=".js_fee_name"
                                    data-value=".js_fee_price"
                                    onclick="order.addFee(event, this, '#feePlusList')">
                                <span class="fa fa-plus"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Đóng lại
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
                {{ formGroupInputVertical('discount[value]', {'label': 'Giảm', 'value': '', 'id': 'discount_value', 'type': 'text', 'class': 'formatCurrency'}) }}
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