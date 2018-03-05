{% extends 'main_layout.volt' %}

{% block content %}
    <div class="m-portlet">
        <div class="m-portlet__body">
            <div class="table-responsive">
                {% for i in 1..10 %}
                <table class="table table-bordered">
                    <tr data-row="0" class="">
                        <td>
                        <span style="width: 40px;">
                            <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                <input type="checkbox" value="15">
                                <span></span>
                            </label>
                        </span>
                        </td>
                        <td>
                            <span style="width: 150px;"><a href="">0006-3917 - PA</a></span>
                        </td>
                        <td>
                            <h5 class="m--font-danger">
                                500.000
                            </h5>
                        </td>
                        <td>
                            <span style="width: 150px;">Trần Quang Minh</span>
                        </td>
                        <td>
                            <span style="width: 110px;">3/10/2017</span>
                        </td>
                        <td>
                            <span style="width: 100px;">
                                <span class="m-badge  m-badge--success m-badge--wide">Success</span>
                            </span>
                        </td>
                        <td>
                            <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                               title="Delete">
                                <i class="la 	la-spinner"></i>
                            </a>
                            <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                               title="Edit details">
                                <i class="la 	la-chevron-down"></i>
                            </a>
                            <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                               title="Delete">
                                <i class="la la-close"></i>
                            </a>

                        </td>
                    </tr>
                    {% endfor %}
                </table>
            </div>
        </div>
    </div>

{% endblock %}