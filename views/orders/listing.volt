{% extends 'main_layout.volt' %}

{% block content %}

    {{ template.openPortlet({"title": "Các đơn hàng", "sub_title": "Tổng cộng <b>500</b> đơn hàng"}) }}
        <div class="topFilter m--margin-bottom-20">
            <div class="pull-left">
                <form action="" class="">
                    <div class=" m--block-inline">
                        <select name="" id="" class="form-control">
                            <option value="">Thao tác</option>
                            <option value="">Từ chối</option>
                            <option value="">Xóa</option>
                        </select>
                    </div>
                    <div class=" m--block-inline">
                        <button class="btn btn-accent">Áp dụng</button>
                    </div>
                </form>
            </div>

            <div class="pull-right">
                <form action="">
                    <div class=" m--block-inline">
                        <input type="number" class="form-control" style="width: 160px" placeholder="ID đơn hàng">
                    </div>
                    <div class=" m--block-inline">
                        <input type="number" class="form-control" style="width: 160px" placeholder="Giá nhỏ">
                    </div>
                    <div class=" m--block-inline">
                        <input type="number" class="form-control" style="width: 160px" placeholder="Giá lớn">
                    </div>
                    <div class=" m--block-inline">
                        <select name="" id="" class="form-control">
                            <option value="">Trạng thái</option>
                        </select>
                    </div>
                    <div class=" m--block-inline">
                        <button class="btn btn-primary">Áp dụng</button>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>



        <div class="table-responsive">
            <table class="table table-bordered">
                {% if result.total_items > 0 %}
                    {% for order in result.items %}
                        <tr data-row="0" class="">

                            <td style="width: 1%">
                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                    <input type="checkbox" value="15">
                                    <span></span>
                                </label>
                            </td>
                            <td width="1%">
                                <span class="noenter">{{ order.getStatusHtml() }}</span>
                            </td>
                            <td>
                                <span style="width: 150px;">
                                    <a href="{{ url.get({'for': 'order_edit', 'id': order.order_id}) }}">
                                        <b class="m--icon-font-size-lg1">#{{ order.order_id }}</b> {{ order.getIp() }}
                                    </a>
                                </span>
                            </td>
                            <td>
                                <b class="m--font-danger m--icon-font-size-lg1">
                                    {{ util.currencyFormat(order.total_price) }}
                                </b>
                                (<b class="m--icon-font-size-sm2">{{ order.total_qty }}</b> sản phẩm)
                            </td>
                            <td>
                                <a href=""><span>{{ order.customer_name }}</span></a>
                            </td>
                            <td>
                                <span>{{ util.formatDat(order.created_at) }}</span>
                            </td>
                            <td class="text-right noenter" width="1%">
                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-{{ template.getColorStatusOrder(constant('\Common\Constant::ORDER_STATUS_PROCESSING')) }} m-btn--icon m-btn--icon-only m-btn--pill"
                                        title="Delete">
                                    <i class="la 	la-spinner"></i>
                                </button>
                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-{{ template.getColorStatusOrder(constant('\Common\Constant::ORDER_STATUS_COMPLETE')) }} m-btn--icon m-btn--icon-only m-btn--pill"
                                        title="Edit details">
                                    <i class="la 	la-chevron-down"></i>
                                </button>
                                <button class="m-portlet__nav-link btn m-btn m-btn--hover-{{ template.getColorStatusOrder(constant('\Common\Constant::ORDER_STATUS_CANCEL')) }} m-btn--icon m-btn--icon-only m-btn--pill"
                                        title="Delete">
                                    <i class="la la-close"></i>
                                </button>
                            </td>
                        </tr>
                    {% endfor %}
                {% endif %}
            </table>
        </div>

        {{ template.pagination(result.total_pages , result.current, 3) }}
    {{ template.closePortlet() }}

{% endblock %}