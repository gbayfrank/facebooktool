<div class="site-header__topbar topbar">
    <div class="topbar__container container">
        <div class="topbar__row">
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="about-us.html">About Us</a>
            </div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="contact-us.html">Contacts</a>
            </div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="">Store Location</a></div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="track-order.html">Track Order</a>
            </div>
            <div class="topbar__item topbar__item--link">
                <a class="topbar-link" href="blog-classic.html">Blog</a>
            </div>
            <div class="topbar__spring"></div>
            <div class="topbar__item">
                <div class="topbar-dropdown">
                    <button class="topbar-dropdown__btn" type="button">
                        My Account 
                        <svg width="7px" height="5px">
                            <use xlink:href="{{ asset('fontend/images/sprite.svg#arrow-rounded-down-7x5') }}"></use>
                        </svg>
                    </button>
                    <div class="topbar-dropdown__body">
                        <!-- .menu -->
                        <div class="menu menu--layout--topbar">
                            <div class="menu__submenus-container"></div>
                            <ul class="menu__list">
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="account-dashboard.html">Dashboard</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="account-profile.html">Edit Profile</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="account-orders.html">Order History</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="account-addresses.html">Addresses</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="account-password.html">Password</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="account-login.html">Logout</a>
                                </li>
                            </ul>
                        </div><!-- .menu / end -->
                    </div>
                </div>
            </div>
            <div class="topbar__item">
                <div class="topbar-dropdown">
                    <button class="topbar-dropdown__btn" type="button">Currency: <span class="topbar__item-value">USD</span> 
                        <svg width="7px" height="5px">
                            <use xlink:href="{{ asset('fontend/images/sprite.svg#arrow-rounded-down-7x5') }}"></use>
                        </svg>
                    </button>
                    <div class="topbar-dropdown__body">
                        <!-- .menu -->
                        <div class="menu menu--layout--topbar">
                            <div class="menu__submenus-container"></div>
                            <ul class="menu__list">
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="">€ Euro</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="">£ Pound Sterling</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="">$ US Dollar</a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="">₽ Russian Ruble</a>
                                </li>
                            </ul>
                        </div><!-- .menu / end -->
                    </div>
                </div>
            </div>
            <div class="topbar__item">
                <div class="topbar-dropdown">
                    <button class="topbar-dropdown__btn" type="button">Language: <span class="topbar__item-value">EN</span> 
                        <svg width="7px" height="5px">
                            <use xlink:href="{{ asset('fontend/images/sprite.svg#arrow-rounded-down-7x5') }}"></use>
                        </svg>
                    </button>
                    <div class="topbar-dropdown__body">
                        <!-- .menu -->
                        <div class="menu menu--layout--topbar menu--with-icons">
                            <div class="menu__submenus-container"></div>
                            <ul class="menu__list">
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="">
                                        <div class="menu__item-icon">
                                            <img srcset="images/languages/language-1.png, images/languages/language-1@2x.png 2x" src="{{ asset('fontend/images/languages/language-1.png') }}" alt="">
                                        </div>
                                        English
                                    </a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div><a
                                        class="menu__item-link" href="">
                                        <div class="menu__item-icon">
                                            <img srcset="images/languages/language-2.png, images/languages/language-2@2x.png 2x" src="{{ asset('fontend/images/languages/language-2.png') }}" alt="">
                                        </div>
                                        French
                                    </a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div><a
                                        class="menu__item-link" href="">
                                        <div class="menu__item-icon">
                                            <img srcset="images/languages/language-3.png, images/languages/language-3@2x.png 2x" src="{{ asset('fontend/images/languages/language-3.png') }}" alt=""></div>
                                        German
                                    </a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="">
                                        <div class="menu__item-icon">
                                            <img srcset="images/languages/language-4.png, images/languages/language-4@2x.png 2x" src="{{ asset('fontend/images/languages/language-4.png') }}" alt=""></div>
                                        Russian
                                    </a>
                                </li>
                                <li class="menu__item">
                                    <div class="menu__item-submenu-offset"></div>
                                    <a class="menu__item-link" href="">
                                        <div class="menu__item-icon">
                                            <img srcset="images/languages/language-5.png, images/languages/language-5@2x.png 2x" src="{{ asset('fontend/images/languages/language-5.png') }}" alt="">
                                        </div>
                                        Italian
                                    </a>
                                </li>
                            </ul>
                        </div><!-- .menu / end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>