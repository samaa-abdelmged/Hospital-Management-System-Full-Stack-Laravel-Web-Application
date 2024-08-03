<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">

        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">
                    <div class="dropdown  nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                            aria-expanded="false">
                            @if (App::getLocale() == 'ar')
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="{{ URL::asset('Dashboard/img/flags/egypt_flag.jpg') }}"
                                        alt="img"></span>
                                <strong
                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @else
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="{{ URL::asset('Dashboard/img/flags/us_flag.jpg') }}" alt="img"></span>
                                <strong
                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @endif
                            <div class="my-auto">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    @if ($properties['native'] == 'English')
                                        <i class="flag-icon flag-icon-us"></i>
                                    @elseif($properties['native'] == 'العربية')
                                        <i class="flag-icon flag-icon-eg"></i>
                                    @endif
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
            <div class="nav nav-item  navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default nav-link resp-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                @auth
                    <li class="dropdown dropdown-notification nav-item  dropdown-notifications">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                            <i class="fa fa-bell"> </i>
                            <span
                                class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow   notif-count"
                                data-count="9">9</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0 text-center">
                                    <span class="grey darken-2 text-center"> الرسائل</span>
                                </h6>
                            </li>
                            <li class="scrollable-container ps-container ps-active-y media-list w-100">
                                <a href="">
                                    <div class="media">
                                        <div class="media-body">
                                            <h6 class="media-heading text-right ">عنوان الاشعار </h6>
                                            <p class="notification-text font-small-3 text-muted text-right"> نص الاشعار</p>
                                            <small style="direction: ltr;">
                                                <p class=" text-muted text-right" style="direction: ltr;"> 20-05-2020 -
                                                    06:00 pm
                                                </p>
                                                <br>

                                            </small>
                                        </div>
                                    </div>
                                </a>

                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="">
                                    جميع الاشعارات </a>
                            </li>
                        </ul>
                    </li>
                @endauth
                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-maximize">
                            <path
                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                            </path>
                        </svg>
                    </a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt=""
                            src="{{ URL::asset('Dashboard/img/faces/6.jpg') }}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt=""
                                        src="{{ URL::asset('Dashboard/img/faces/6.jpg') }}" class=""></div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ auth()->user()->name }}</h6><span>{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>الملف الشخصي</a>
                        <a class="dropdown-item" href=""><i class="bx bx-cog"></i>تعديل الملف الشخصي</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();"><i
                                    class="bx bx-log-out"></i>{{ trans('main-header.login_up') }}</a>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('472d45265cfea4770930', {
        cluster: 'mt1'
    });
</script>
<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
    var notificationsCountElem = notificationsToggle.find('span[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));
    var notifications = notificationsWrapper.find('li.scrollable-container');

    // Subscribe to the channel we specified in our Laravel Event
    var channel = pusher.subscribe('new-comment');
    // Bind a function to a Event (the full Laravel class)
    channel.bind('App\\Events\\NewCommentEvent', function(data) {
        var existingNotifications = notifications.html();
        var newNotificationHtml = `<a href="` + data.admin_id +
            `"><div class="media-body"><h6 class="media-heading text-right">` + data.admin_name +
            `</h6> <p class="notification-text font-small-3 text-muted text-right">` + data.comment +
            `</p><small style="direction: ltr;"><p class="media-meta text-muted text-right" style="direction: ltr;">` +
            data.date + data.time + `</p> </small></div></div></a>`;
        notifications.html(newNotificationHtml + existingNotifications);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });
</script>
<script src="{{ asset('js/pusherNotifications') }}"></script>


<!-- /main-header -->
