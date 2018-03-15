{% extends 'main_layout.volt' %}

{% block content %}

    {{ template.openPortlet({"title": "Các đơn hàng", "sub_title": "Tổng cộng <b>500</b> đơn hàng"}) }}

        <div class="topFilter m--margin-bottom-20">
            <form action="" class="">
                <div class="pull-left">

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
                </div>

                <div class="pull-right">
                    <div class=" m--block-inline">
                        <input type="number" value="{{ request.getQuery('order_id', ['int'], '') }}" name="order_id" class="form-control" style="width: 160px" placeholder="ID đơn hàng">
                    </div>

                    <div class=" m--block-inline">
                        <select name="date_range" id="" class="form-control" onchange="form.submit()">
                            <option {{ request.getQuery('date_range', ['striptags', 'trim'], '') == "" ? "selected" : "" }} value="">Chọn ngày</option>
                            <option {{ request.getQuery('date_range', ['striptags', 'trim'], '') == "now" ? "selected" : "" }} value="now">Trong ngày</option>
                            <option {{ request.getQuery('date_range', ['striptags', 'trim'], '') == "star_week" ? "selected" : "" }} value="star_week">Từ thứ 2</option>
                            <option {{ request.getQuery('date_range', ['striptags', 'trim'], '') == "star_month" ? "selected" : "" }} value="star_month">Từ đầu tháng (ngày 1)</option>
                            <option {{ request.getQuery('date_range', ['striptags', 'trim'], '') == "7dayago" ? "selected" : "" }} value="7dayago">7 ngày trước</option>
                            <option {{ request.getQuery('date_range', ['striptags', 'trim'], '') == "15dayago" ? "selected" : "" }} value="15dayago">15 ngày trước</option>
                            <option {{ request.getQuery('date_range', ['striptags', 'trim'], '') == "30dayago" ? "selected" : "" }} value="30dayago">30 ngày trước</option>
                        </select>
                    </div>

                    <div class=" m--block-inline">
                        <select name="status" id="" class="form-control" onchange="form.submit()">
                            {{ template.optionsStatusOrder(request.getQuery('status')) }}
                        </select>
                    </div>
                    <div class=" m--block-inline">
                        <select name="sort" id="" class="form-control" onchange="form.submit()">
                            <option value="">Sắp xếp</option>
                            <option {{ request.getQuery('sort', ['striptags', 'trim'], '') == "create" ? "selected" : "" }} value="create">Ngày tạo</option>
                            <option {{ request.getQuery('sort', ['striptags', 'trim'], '') == "update" ? "selected" : "" }} value="update">Ngày cập nhật</option>
                        </select>
                    </div>
                    <div class=" m--block-inline">
                        <button class="btn btn-primary">Áp dụng</button>
                    </div>
                </div>
            </form>
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