<?php

namespace Common;

class Template {

    public function getColorStatusOrder($status)
    {
        $status = Constant::getStatus($status);

        if (is_array($status) && count($status) && isset($status['color'])) {
            return $status['color'];
        } else {
            return '';
        }
    }

    public function pagination($totalPages, $currentPage, $lengthPage)
    {

        $min = max(1, $currentPage - $lengthPage);
        $step = $lengthPage - ($currentPage - $min);
        $lengthPage += $step;
        $max = min($totalPages, ($currentPage + $lengthPage));

        if (($max - $min) < $lengthPage *2 && $min > 1) {
            $min = max(1, ($currentPage - $lengthPage *2) + ($max - $currentPage));
        }

        $html = "<nav><ul class='pagination'>";
            for ($i = $min; $i <= $max; $i ++) {
                $active = ($currentPage == $i) ? 'active link-active' : '';
                $url = Util::addQueryArg(array('page' => $i));
                $html .= "<li class='page-item {$active}'><a class='page-link' href='{$url}'>{$i}</a></li>";
            }
        $html .= "</ul></nav>";

        return $html;
    }

    public function optionsStatusOrder($value = '') {

        $html = "<option value=''>Chọn trạng thái</option>";
        foreach (Constant::getStatus() as $key => $status) {
            $checked = ($key == $value ) ? 'selected' : '';
            $html .= "<option {$checked} value='{$key}'>{$status['label']}</option>";
        }

        return $html;
    }

    public function openPortlet($args)
    {
        $html = '';
        $html .= "<div class='m-portlet m-portlet--mobile'>";
        if (isset($args['title'])){

            $html .= "<div class='m-portlet__head'>";
            $html .= "<div class='m-portlet__head-caption'>";
            $html .= "<div class='m-portlet__head-title'>";
            $html .= "<h3 class='m-portlet__head-text'>";
            $html .= $args['title'];

            if (isset($args['sub_title'])) {
                $html .= "<small>{$args['sub_title']}</small>";
            }

            $html .= "</h3></div></div></div>";
        }

        $html .= "<div class='m-portlet__body'>";

        return $html;
    }

    public function closePortlet(){
        return '</div>';
    }
}