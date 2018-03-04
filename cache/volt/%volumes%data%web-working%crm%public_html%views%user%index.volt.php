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
							<a href="index.html" class="m-brand__logo-wrapper">
								<img alt="" src="assets/demo/default/media/img/logo/logo_default_dark.png" />
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
                                                <img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless m--img-centered" alt="" />
                                            </span>
										<span class="m-topbar__username m--hide">
                                                Nick
                                            </span>
									</a>
									<div class="m-dropdown__wrapper">
										<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
										<div class="m-dropdown__inner">
											<div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
												<div class="m-card-user m-card-user--skin-dark">
													<div class="m-card-user__pic">
														<img src="assets/app/media/img/users/user4.jpg" class="m--img-rounded m--marginless" alt="" />
													</div>
													<div class="m-card-user__details">
                                                            <span class="m-card-user__name m--font-weight-500">
                                                                Mark Andre
                                                            </span>
														<a href="" class="m-card-user__email m--font-weight-300 m-link">
															mark.andre@gmail.com
														</a>
													</div>
												</div>
											</div>
											<div class="m-dropdown__body">
												<div class="m-dropdown__content">
													<ul class="m-nav m-nav--skin-light">
														<li class="m-nav__section m--hide">
                                                                <span class="m-nav__section-text">
                                                                    Section
                                                                </span>
														</li>

														<li class="m-nav__item">
															<a href="header/profile.html" class="m-nav__link">
																<i class="m-nav__link-icon flaticon-share"></i>
																<span class="m-nav__link-text">
                                                                        Activity
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
					<li class="m-menu__item  m-menu__item--active" aria-haspopup="true">
						<a href="index.html" class="m-menu__link ">
							<i class="m-menu__link-icon flaticon-line-graph"></i>
							<span class="m-menu__link-title">
								<span class="m-menu__link-wrap">
									<span class="m-menu__link-text">
										Dashboard
									</span>
									<span class="m-menu__link-badge">
										<span class="m-badge m-badge--danger">
											2
										</span>
									</span>
								</span>
							</span>
						</a>
					</li>
					<li class="m-menu__item m-menu__item--submenu m-menu__item--open" aria-haspopup="true" data-menu-submenu-toggle="hover">
						<a href="#" class="m-menu__link m-menu__toggle">
							<i class="m-menu__link-icon flaticon-tabs"></i>
							<span class="m-menu__link-text">
										Datatables
									</span>
							<i class="m-menu__ver-arrow la la-angle-right"></i>
						</a>
						<div class="m-menu__submenu " style="display: block;">
							<span class="m-menu__arrow"></span>
							<ul class="m-menu__subnav">
								<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
											<span class="m-menu__link">
												<span class="m-menu__link-text">
													Datatables
												</span>
											</span>
								</li>
								<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
									<a href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">
													Base
												</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu ">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/data-local.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Local Data
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/data-json.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																JSON Data
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/data-ajax.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Ajax Data
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/html-table.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																HTML Table
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/record-selection.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Record Selection
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/local-sort.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Local Sort
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/row-details.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Row Details
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/column-rendering.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Column Rendering
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/column-width.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Column Width
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/responsive-columns.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Responsive Columns
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/base/translation.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Translation
															</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
									<a href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">
													Scrolling
												</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu ">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/scrolling/vertical.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Vertical Scrolling
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/scrolling/horizontal.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Horizontal Scrolling
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/scrolling/both.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Both Scrolling
															</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
									<a href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">
													Locked Columns
												</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu ">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/locked/left.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Left Locked Columns
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/locked/right.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Right Locked Columns
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/locked/both.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Both Locked Columns
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/locked/html-table.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																HTML Table
															</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
									<a href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">
													Child Datatables
												</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu ">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/child/data-local.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Local Data
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/child/data-ajax.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Remote Data
															</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
								<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
									<a href="#" class="m-menu__link m-menu__toggle">
										<i class="m-menu__link-bullet m-menu__link-bullet--dot">
											<span></span>
										</i>
										<span class="m-menu__link-text">
													API
												</span>
										<i class="m-menu__ver-arrow la la-angle-right"></i>
									</a>
									<div class="m-menu__submenu ">
										<span class="m-menu__arrow"></span>
										<ul class="m-menu__subnav">
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/api/methods.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																API Methods
															</span>
												</a>
											</li>
											<li class="m-menu__item " aria-haspopup="true">
												<a href="components/datatables/api/events.html" class="m-menu__link ">
													<i class="m-menu__link-bullet m-menu__link-bullet--dot">
														<span></span>
													</i>
													<span class="m-menu__link-text">
																Events
															</span>
												</a>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</li>
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
                
    <div class="m-portlet">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-xl-4">
                    <!--begin:: Widgets/Stats2-1 -->
                    <div class="m-widget1">
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
                    <!--end:: Widgets/Stats2-1 -->
                </div>
                <div class="col-xl-4">
                    <!--begin:: Widgets/Daily Sales-->
                    <div class="m-widget14">
                        <div class="m-widget14__header m--margin-bottom-30">
                            <h3 class="m-widget14__title">
                                Daily Sales
                            </h3>
                            <span class="m-widget14__desc">
													Check out each collumn for more details
												</span>
                        </div>
                        <div class="m-widget14__chart" style="height:120px;">
                            <canvas  id="m_chart_daily_sales"></canvas>
                        </div>
                    </div>
                    <!--end:: Widgets/Daily Sales-->
                </div>
                <div class="col-xl-4">
                    <!--begin:: Widgets/Profit Share-->
                    <div class="m-widget14">
                        <div class="m-widget14__header">
                            <h3 class="m-widget14__title">
                                Profit Share
                            </h3>
                            <span class="m-widget14__desc">
													Profit Share between customers
												</span>
                        </div>
                        <div class="row  align-items-center">
                            <div class="col">
                                <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                    <div class="m-widget14__stat">
                                        45
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="m-widget14__legends">
                                    <div class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-accent"></span>
                                        <span class="m-widget14__legend-text">
																37% Sport Tickets
															</span>
                                    </div>
                                    <div class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-warning"></span>
                                        <span class="m-widget14__legend-text">
																47% Business Events
															</span>
                                    </div>
                                    <div class="m-widget14__legend">
                                        <span class="m-widget14__legend-bullet m--bg-brand"></span>
                                        <span class="m-widget14__legend-text">
																19% Others
															</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Profit Share-->
                </div>
            </div>
        </div>
    </div>

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