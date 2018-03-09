<?php $this->_macros['formGroupText'] = function($__p = null) { if (isset($__p[0])) { $name = $__p[0]; } else { if (isset($__p["name"])) { $name = $__p["name"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'formGroupText' was called without parameter: name");  } } if (isset($__p[1])) { $data = $__p[1]; } else { if (isset($__p["data"])) { $data = $__p["data"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'formGroupText' was called without parameter: data");  } }  ?>
    <div class="form-group m-form__group row">
        <label for="<?= $data['id'] ?>" class="col-3 col-form-label">
            <?= $data['label'] ?>
        </label>

        <div class="col-9">
            <input class="form-control m-input" name="<?= $name ?>" type="text" value="<?= (isset($data['value']) ? $data['value'] : '') ?>" id="<?= $data['id'] ?>">
        </div>
    </div><?php }; $this->_macros['formGroupText'] = \Closure::bind($this->_macros['formGroupText'], $this); ?><?php $this->_macros['formGroupInputVertical'] = function($__p = null) { if (isset($__p[0])) { $name = $__p[0]; } else { if (isset($__p["name"])) { $name = $__p["name"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'formGroupInputVertical' was called without parameter: name");  } } if (isset($__p[1])) { $data = $__p[1]; } else { if (isset($__p["data"])) { $data = $__p["data"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'formGroupInputVertical' was called without parameter: data");  } }  ?>
    <div class="form-group">
        <label for="<?= $data['id'] ?>" class="col-form-label">
            <?= $data['label'] ?>
        </label>
        <?php if ($data['type'] == 'text') { ?>
            <input class="form-control m-input" name="<?= $name ?>" type="text" value="<?= (isset($data['value']) ? $data['value'] : '') ?>" id="<?= $data['id'] ?>">
        <?php } elseif ($data['type'] == 'number') { ?>
            <input class="form-control m-input" name="<?= $name ?>" type="number" value="<?= (isset($data['value']) ? $data['value'] : '') ?>" id="<?= $data['id'] ?>">
        <?php } elseif ($data['type'] == 'textarea') { ?>
            <textarea name="<?= $name ?>" id="<?= $data['id'] ?>" class="form-control" rows="3"></textarea>
        <?php } ?>

    </div><?php }; $this->_macros['formGroupInputVertical'] = \Closure::bind($this->_macros['formGroupInputVertical'], $this); ?><?php $this->_macros['formGroupInputGroup2Text'] = function($__p = null) { if (isset($__p[0])) { $name = $__p[0]; } else { if (isset($__p["name"])) { $name = $__p["name"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'formGroupInputGroup2Text' was called without parameter: name");  } } if (isset($__p[1])) { $data = $__p[1]; } else { if (isset($__p["data"])) { $data = $__p["data"]; } else {  throw new \Phalcon\Mvc\View\Exception("Macro 'formGroupInputGroup2Text' was called without parameter: data");  } }  ?>
    <div class="form-group m-form__group">
        <div class="input-group">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">
                    <?= $data['label'] ?>
                </span>
            </div>

            <input type="text" class="form-control m-input" placeholder="" aria-describedby="basic-addon2">

            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">
                    <?= $data['label_after'] ?>
                </span>
            </div>
        </div>
    </div><?php }; $this->_macros['formGroupInputGroup2Text'] = \Closure::bind($this->_macros['formGroupInputGroup2Text'], $this); ?>



<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>

	</title>
	<link href="<?= $this->url->get() ?>/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"
	/>
	<link href="<?= $this->url->get() ?>/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= $this->url->get() ?>/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= $this->url->get() ?>/assets/css/main.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?= $this->url->get() ?>/assets/demo/default/media/img/logo/favicon.ico" />


	<!--begin::Base Scripts -->
	<script src="<?= $this->url->get() ?>assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
	<script src="<?= $this->url->get() ?>assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
	<!--end::Base Scripts -->
	<!--begin::Page Vendors -->
	<script src="<?= $this->url->get() ?>assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
	<!--end::Page Vendors -->
	<!--begin::Page Snippets -->
	<script src="<?= $this->url->get() ?>assets/app/js/dashboard.js" type="text/javascript"></script>
	<!--end::Page Snippets -->
	<script src="<?= $this->url->get() ?>assets/demo/default/custom/components/forms/widgets/select2.js" type="text/javascript"></script>
	<script src="<?= $this->url->get() ?>assets/js/app.js"></script>
	<script src="<?= $this->url->get() ?>assets/js/nano.js"></script>
	<script src="<?= $this->url->get() ?>assets/js/wnumb-1.1.03/wNumb.js"></script>
	<script>
        var numberFormat = wNumb({
            mark: '.',
            thousand: ','
        });
	</script>
</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
	<!-- BEGIN: Header -->
	<header class="m-grid__item    m-header " data-minimize-offset="200" data-minimize-mobile-offset="200">
		<div class="m-container m-container--fluid m-container--full-height">
			<div class="m-stack m-stack--ver m-stack--desktop">
				<!-- BEGIN: Brand -->
				<div class="m-stack__item m-brand  m-brand--skin-dark ">
					<div class="m-stack m-stack--ver m-stack--general">
						<div class="m-stack__item m-stack__item--middle m-brand__logo">
							<a href="<?= $this->url->get() ?>" class="m-brand__logo-wrapper">
								<img alt="" src="<?= $this->url->get() ?>assets/demo/default/media/img/logo/logo_default_dark.png" />
							</a>
						</div>
						<div class="m-stack__item m-stack__item--middle m-brand__tools">
							<!-- BEGIN: Left Aside Minimize Toggle -->
							<a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block ">
								<span></span>
							</a>
							<!-- END -->
							<!-- BEGIN: Responsive Aside Left Menu Toggler -->
							<a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
								<span></span>
							</a>
							<!-- END -->
							<!-- BEGIN: Responsive Header Menu Toggler -->
							<a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
								<span></span>
							</a>
							<!-- END -->
							<!-- BEGIN: Topbar Toggler -->
							<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
								<i class="flaticon-more"></i>
							</a>
							<!-- BEGIN: Topbar Toggler -->
						</div>
					</div>
				</div>
				<!-- END: Brand -->
				<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
					<!-- BEGIN: Horizontal Menu -->
					<button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
						<i class="la la-close"></i>
					</button>

					<!-- END: Horizontal Menu -->
					<!-- BEGIN: Topbar -->
					<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
						<div class="m-stack__item m-topbar__nav-wrapper">
							<ul class="m-topbar__nav m-nav m-nav--inline">

    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
        data-dropdown-toggle="click">
        <a href="#" class="m-nav__link m-dropdown__toggle">
										<span class="m-topbar__userpic">
											<img src="<?= $userCurrent->getAvatar() ?>" class="m--img-rounded m--marginless m--img-centered" alt="" />
										</span>
            <span class="m-topbar__username m--hide">
											<?= $userCurrent->getName() ?>
										</span>
        </a>
        <div class="m-dropdown__wrapper">
            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
            <div class="m-dropdown__inner">
                <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                    <div class="m-card-user m-card-user--skin-dark">
                        <div class="m-card-user__pic">
                            <img src="<?= $userCurrent->getAvatar() ?>" class="m--img-rounded m--marginless" alt="" />
                        </div>
                        <div class="m-card-user__details">
                                                            <span class="m-card-user__name m--font-weight-500">
                                                                <?= $userCurrent->getName() ?>
                                                            </span>
                            <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                <?= $userCurrent->user_email ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="m-dropdown__body">
                    <div class="m-dropdown__content">
                        <ul class="m-nav m-nav--skin-light">
                            <li class="m-nav__section m--hide"><span class="m-nav__section-text">Section</span></li>

                            <li class="m-nav__item">
                                <a href="#" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-share"></i>
                                    <span class="m-nav__link-text">
																	Chỉnh sửa thông tin
																</span>
                                </a>
                            </li>

                            <li class="m-nav__separator m-nav__separator--fit"></li>

                            <li class="m-nav__item">
                                <a href="<?= $this->url->get(['for' => 'auth_logout']) ?>" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                    Thoát
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
						</div>
					</div>
					<!-- END: Topbar -->
				</div>
			</div>
		</div>
	</header>
	<!-- END: Header -->


	<!-- begin::Body -->
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
		<!-- BEGIN: Left Aside -->
		<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
			<i class="la la-close"></i>
		</button>

		<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
			<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true"
     data-menu-scrollable="false" data-menu-dropdown-timeout="500">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <?php foreach ($main_menu[0] as $menuItem) { ?>
            <?php $hasSub = (isset($main_menu[$menuItem['name']]) ? true : false); ?>
            <li class="m-menu__item <?= ($hasSub ? 'm-menu__item--submenu' : '') ?> " aria-haspopup="true"  data-menu-submenu-toggle="hover">
                
                <a href="<?= (isset($main_menu[$menuItem['name']]) ? 'javascript:;' : $menuItem['url']) ?>"
                   class="m-menu__link <?= ($hasSub ? 'm-menu__toggle' : '') ?>"
                    <?= ($hasSub ? 'data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true"' : '') ?>
                >
                    <i class="m-menu__link-icon <?= $menuItem['icon_menu'] ?>"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                <?= $menuItem['title_menu'] ?>
                            </span>

                            <?php if ($hasSub) { ?>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            <?php } ?>
                        </span>
                    </span>
                </a>

                <?php if (isset($main_menu[$menuItem['name']])) { ?>
                    <div class="m-menu__submenu m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item" aria-haspopup="true">
                                <a href="<?= $menuItem['url'] ?>" class="m-menu__link ">
                                    <i class="m-menu__link-icon <?= $menuItem['icon_menu'] ?>"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                <?= $menuItem['title_menu'] ?>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?php foreach ($main_menu[$menuItem['name']] as $menuSubItem) { ?>
                            <li class="m-menu__item" aria-haspopup="true">
                                <a href="<?= $menuSubItem['url'] ?>" class="m-menu__link ">
                                    <i class="m-menu__link-icon <?= $menuSubItem['icon_menu'] ?>"></i>
                                    <span class="m-menu__link-title">
                                        <span class="m-menu__link-wrap">
                                            <span class="m-menu__link-text">
                                                <?= $menuSubItem['title_menu'] ?>
                                            </span>
                                        </span>
                                    </span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </li>
        <?php } ?>

        <li class="m-menu__section">
            <h4 class="m-menu__section-text">
                Components
            </h4>
            <i class="m-menu__section-icon flaticon-more-v3"></i>
        </li>

    </ul>
</div>
		</div>
		<!-- END: Left Aside -->

		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<?= $this->flashSession->output() ?>
                

    <div class="m-content">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Your Profile
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <img src="../assets/app/media/img/users/user4.jpg" alt=""/>
                                </div>
                            </div>
                            <div class="m-card-profile__details">
												<span class="m-card-profile__name">
													Mark Andre
												</span>
                                <a href="" class="m-card-profile__email m-link">
                                    mark.andre@gmail.com
                                </a>
                            </div>
                        </div>
                        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                            <li class="m-nav__separator m-nav__separator--fit"></li>
                            <li class="m-nav__section m--hide">
												<span class="m-nav__section-text">
													Section
												</span>
                            </li>
                            <li class="m-nav__item">
                                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-profile-1"></i>
                                    <span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">
																My Profile
															</span>
															<span class="m-nav__link-badge">
																<span class="m-badge m-badge--success">
																	2
																</span>
															</span>
														</span>
													</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-share"></i>
                                    <span class="m-nav__link-text">
														Activity
													</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                    <span class="m-nav__link-text">
														Messages
													</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-graphic-2"></i>
                                    <span class="m-nav__link-text">
														Sales
													</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-time-3"></i>
                                    <span class="m-nav__link-text">
														Events
													</span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                    <span class="m-nav__link-text">
														Support
													</span>
                                </a>
                            </li>
                        </ul>
                        <div class="m-portlet__body-separator"></div>
                        <div class="m-widget1 m-widget1--paddingless">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Member Profit
                                        </h3>
                                        <span class="m-widget1__desc">
															Awerage Weekly Profit
														</span>
                                    </div>
                                    <div class="col m--align-right">
														<span class="m-widget1__number m--font-brand">
															+$17,800
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Orders
                                        </h3>
                                        <span class="m-widget1__desc">
															Weekly Customer Orders
														</span>
                                    </div>
                                    <div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">
															+1,800
														</span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Issue Reports
                                        </h3>
                                        <span class="m-widget1__desc">
															System bugs and issues
														</span>
                                    </div>
                                    <div class="col m--align-right">
														<span class="m-widget1__number m--font-success">
															-27,49%
														</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Update Profile
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                        Messages
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                        Settings
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-portlet__nav-item--last">
                                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                        <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                            <i class="la la-gear"></i>
                                        </a>
                                        <div class="m-dropdown__wrapper">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__body">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav">
                                                            <li class="m-nav__section m-nav__section--first">
																				<span class="m-nav__section-text">
																					Quick Actions
																				</span>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                                    <span class="m-nav__link-text">
																						Create Post
																					</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                    <span class="m-nav__link-text">
																						Send Messages
																					</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                                    <span class="m-nav__link-text">
																						Upload File
																					</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__section">
																				<span class="m-nav__section-text">
																					Useful Links
																				</span>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                                    <span class="m-nav__link-text">
																						FAQ
																					</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__item">
                                                                <a href="" class="m-nav__link">
                                                                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                    <span class="m-nav__link-text">
																						Support
																					</span>
                                                                </a>
                                                            </li>
                                                            <li class="m-nav__separator m-nav__separator--fit m--hide"></li>
                                                            <li class="m-nav__item m--hide">
                                                                <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                                    Submit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <form class="m-form m-form--fit m-form--label-align-right">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group m--margin-top-10 m--hide">
                                        <div class="alert m-alert m-alert--default" role="alert">
                                            The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                            <h3 class="m-form__section">
                                                1. Personal Details
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Full Name
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="Mark Andre">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Occupation
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="CTO">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Company Name
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="Keenthemes">
                                            <span class="m-form__help">
																If you want your invoices addressed to a company. Leave blank to use your full name.
															</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Phone No.
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="+456669067890">
                                        </div>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                            <h3 class="m-form__section">
                                                2. Address
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Address
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="L-12-20 Vertex, Cybersquare">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            City
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="San Francisco">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            State
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="California">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Postcode
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="45000">
                                        </div>
                                    </div>
                                    <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                            <h3 class="m-form__section">
                                                3. Social Links
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Linkedin
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="www.linkedin.com/Mark.Andre">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Facebook
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="www.facebook.com/Mark.Andre">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Twitter
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="www.twitter.com/Mark.Andre">
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Instagram
                                        </label>
                                        <div class="col-7">
                                            <input class="form-control m-input" type="text" value="www.instagram.com/Mark.Andre">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-7">
                                                <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                    Save changes
                                                </button>
                                                &nbsp;&nbsp;
                                                <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane " id="m_user_profile_tab_2"></div>
                        <div class="tab-pane " id="m_user_profile_tab_3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

			</div>
		</div>
		<div class="clearfix"></div>

	</div>
	<!-- end:: Body -->

</div>
<!-- end:: Page -->
<!-- end::Body -->
</body>

</html>