<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<title>

	</title>
	<!--begin::Web font -->
	<script src="<?= $this->url->get() ?>/assets/vendors/base/fonts/webfont.js"></script>
	<script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
	</script>
	<!--end::Web font -->

	<link href="<?= $this->url->get() ?>/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"
	/>
	<link href="<?= $this->url->get() ?>/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= $this->url->get() ?>/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?= $this->url->get() ?>/assets/demo/default/media/img/logo/favicon.ico" />


	<script type="text/javascript"></script>

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
			<!-- BEGIN: Aside Menu -->
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
			<!-- END: Aside Menu -->
		</div>
		<!-- END: Left Aside -->


		<div class="m-grid__item m-grid__item--fluid m-wrapper">
			<div class="m-content">
				<?= $this->flashSession->output() ?>
                
Lorem ipsum dolor sit amet, consectetur adipisicing elit. At dolor dolore eaque, iure molestiae repudiandae sunt tempore unde. Ab ad assumenda consectetur consequatur culpa doloribus eligendi esse eveniet ex facere, facilis fuga magni molestias nesciunt nostrum officia perspiciatis quaerat quas, reiciendis repellat tenetur voluptate voluptatibus.


			</div>
		</div>
	</div>
	<!-- end:: Body -->

</div>
<!-- end:: Page -->

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
<!-- end::Body -->
</body>

</html>