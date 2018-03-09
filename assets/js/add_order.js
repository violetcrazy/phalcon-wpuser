var dateData = new Date();
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
        orderDetail: $('#order_detail'),
        feePlusList : $('#feePlusList table')
    },
    template: {
        itemLine: $('#temlateItemLine tbody').html(),
        groupTotal: '<tr><td style="width: 60%" class="text-right">{note}</td><td><b>{value}</b></td></tr>',
        feeList: '<tr>\
                    <td class="text-dark">{note}</td>\
                    <td width="1%"><b>{value}</b></td>\
                    <td width="1%">\
                    <button class="btn-xs btn btn-danger" type="button" onclick="order.deleteFee(event, {index})">Xóa</button></td>\
                </tr>'
    },
    reload: function(){
        this.init();
    },
    resetBeforeReder: function(){
        this.selectors.tableItem.html('');
        this.selectors.groupTotal.html('');
        order.selectors.feePlusList.html('');
        this.total = this.subtotal = this.fee_total = 0;
    },
    deleteItem: function(event, index){
        if (typeof this.itemsline[index] != 'undefined') {
            delete this.itemsline[index];
            this.reload();
        }
    },
    changeQty: function(event, index, type){
        if (type === '-') {
            this.itemsline[index]['qty'] --;
            if (this.itemsline[index]['qty'] <= 0) {
                this.itemsline[index]['qty'] = 1;
            }
        } else if(type === '+'){
            this.itemsline[index]['qty'] ++;
        }

        this.reload();
    },
    init: function(){
        var that = this;
        that.resetBeforeReder();

        $.each(that.itemsline, function(index, productData){
            if (typeof productData  !== 'undefined' && productData && productData !== null) {
                productData.index = index;
                productData.price_format = numberFormat.to(productData.price *1);
                productData.total_format = numberFormat.to(productData.price * productData.qty);
                that.selectors.tableItem.prepend(nano(that.template.itemLine, productData));
                that.subtotal += parseFloat(productData.price * productData.qty);
            }
        });

        order.selectors.groupTotal.append(nano(order.template.groupTotal, {
            note: "Sản phẩm",
            value: numberFormat.to(that.subtotal)
        }));

        if (that.fee.length > 0){
            $.each(that.fee, function (index, fee) {
                if (typeof fee === 'object' && fee !== null) {
                    var value = parseFloat(fee.value);
                    if (value > 0) {
                        that.fee_total += value;
                        order.selectors.groupTotal.append(nano(order.template.groupTotal, {
                            note: fee.note,
                            value: numberFormat.to(fee.value)
                        }));
                        order.selectors.feePlusList.append(nano(order.template.feeList, {
                            note: fee.note,
                            value: numberFormat.to(fee.value),
                            index: index
                        }));
                    }
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
    deleteFee: function(event, index){
        if (typeof this.fee[index] != 'undefined') {
            delete this.fee[index];
            this.reload();
        }
    },
    addFee: function(event, targetEvent, el){
        var data = $(targetEvent).data();
        var tr = $(targetEvent).closest('tr');

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
            $(data.note).val('').focus();
            $(data.value).val(0);

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
    },

    saveNote: function(event, url) {
        event.preventDefault();
        var $form = $(event.target).closest('form');
        mApp.block($form, {
            overlayColor: '#000000',
            type: 'loader',
            state: 'primary',
            message: 'Đang xử lý...',
            opacity: 0.3
        });

        var data = $form.serialize();
        $.ajax({
            url: url,
            data: data,
            type : 'post',
            dataType: 'json',
            success: function(res){
                $(document).trigger('loadNotes');
                mApp.unblock($form);
                $form.trigger('reset');
            }
        })
    }
};



$(document).ready(function(){
    $(".formatCurrency").number(true,0);

    $(".selectCskh").select2({
        placeholder: "Tìm nhân viên",
        allowClear: true,
        ajax: {
            url: "https://api.github.com/search/repositories",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function(data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 1,
    });
})