<?php require_once __DIR__ . '/../include/header.php'; ?>
<div class="ttr-sidebar">
    <div class="ttr-sidebar-wrapper content-scroll">
        <!-- side menu logo start -->
        <div class="ttr-sidebar-logo">
            <a href="#">
                <img alt="" src="/public/assets/images/logo.png" width="122" height="27">
            </a>
            <div class="ttr-sidebar-toggle-button">
                <i class="ti-arrow-left"></i>
            </div>
        </div>
        <!-- sidebar menu start -->
        <nav class="ttr-sidebar-navi">
            <ul>
            <li>
                    <a href="dashboard.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-home"></i></span>
                        <span class="ttr-label">Dashborad</span>
                    </a>
                </li>
                <li>
                    <a href="all_posts.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-book"></i></span>
                        <span class="ttr-label">Posts</span>
                    </a>
                </li>
                <li>
                    <a href="all_events.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-book"></i></span>
                        <span class="ttr-label">Events</span>
                    </a>
                </li>
                <li>
                    <a href="user_courses.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-book"></i></span>
                        <span class="ttr-label">Your Learning</span>
                    </a>
                </li>
                <li>
                    <a href="join_events.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-book"></i></span>
                        <span class="ttr-label">Your events</span>
                    </a>
                </li>
               
                <li>
                    <a href="profile.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-user"></i></span>
                        <span class="ttr-label">My Profile</span>
                    </a>
                </li>
                <li class="ttr-seperate"></li>
            </ul>
        </nav>
    </div>
</div>
<main class="ttr-wrapper">
    <!--Main container start -->
    <div class="container-fluid">
        <?php require_once __DIR__ . '/../include/card_header.php'; ?>
    <?php if ($_SESSION['user_role_id'] == 0) : ?>
            <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>All events</h4>
                        </div>
                        <div class="page-wraper">
                            <div class="page-content bg-white">
                                <div class="content-block">
                                    <div class="section-area section-sp1 gallery-bx">
                                        <div class="container">
                                            <div class="clearfix">
                                                <ul id="masonry" class="ttr-gallery-listing magnific-image row" style="list-style: none;">
                                                    <?php $sql = "SELECT * FROM event ORDER BY event_created_at DESC"; ?>
                                                    <?php $stmt = $con->query($sql)->fetchAll(); ?>
                                                    <?php if ($stmt) : ?>
                                                        <?php foreach ($stmt as $row) : ?>
                                                            <li class="action-card col-lg-6 col-md-6 col-sm-12 happening">
                                                                <div class="event-bx m-b30">
                                                                    <div class="action-box">
                                                                        <?php if ($row['event_image'] == null) : ?>
                                                                            <img src="/public/admin/assets/images/background/bg1.jpg" style="height: 250px">
                                                                        <?php else : ?>
                                                                            <img src="/public/event_images/<?php echo $row['event_image']; ?>" style="height: 250px">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="info-bx d-flex">
                                                                        <div class="event-info">
                                                                            <h4 class="event-title"><a href="event_cards.php?details=<?php echo $hash->hash($row['event_id'], 10); ?>"><?php echo $row['event_title']; ?></a></h4>
                                                                            <ul class="media-post">
                                                                                <li><a href="#"><i class="fa fa-clock-o"></i><?php echo $helper->customDateFormat($row['event_created_at']); ?></a></li>
                                                                            </ul>
                                                                            <p><?php echo substr($row['event_description'], 0, 50) ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <li class="action-card col-lg-6 col-md-6 col-sm-12 happening">
                                                            <div class="event-bx m-b30">
                                                                <div class="action-box">
                                                                    <img src="/public/admin/assets/images/background/bg1.jpg" style="height: 250px">
                                                                </div>
                                                                <div class="info-bx d-flex">

                                                                    <div class="event-info">
                                                                        <h4 class="event-title"><a href="#">Education Autumn Tour 2019</a></h4>
                                                                        <ul class="media-post">
                                                                            <li><a href="#"><i class="fa fa-clock-o"></i> 7:00am 8:00am</a></li>
                                                                            <li><a href="#"><i class="fa fa-map-marker"></i> Berlin, Germany</a></li>
                                                                        </ul>
                                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the..</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="action-card col-lg-6 col-md-6 col-sm-12 happening">
                                                            <div class="event-bx m-b30">
                                                                <div class="action-box">
                                                                    <img src="/public/admin/assets/images/background/bg1.jpg" style="height: 250px">
                                                                </div>
                                                                <div class="info-bx d-flex">
                                                                    <div>
                                                                        <div class="event-time">
                                                                            <div class="event-date">29</div>
                                                                            <div class="event-month">October</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="event-info">
                                                                        <h4 class="event-title"><a href="#">Education Autumn Tour 2019</a></h4>
                                                                        <ul class="media-post">
                                                                            <li><a href="#"><i class="fa fa-clock-o"></i> 7:00am 8:00am</a></li>
                                                                            <li><a href="#"><i class="fa fa-map-marker"></i> Berlin, Germany</a></li>
                                                                        </ul>
                                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the..</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <!-- end fetch events -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    <?php else :  ?>
        <!-- Check if user is not admin, show them card without edit -->
        <div class="container-fluid">
            <?php require_once __DIR__ . '/../include/card_header.php'; ?>
            <div class="row">
                <!-- Your Profile Views Chart -->
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <div class="wc-title">
                            <h4>All events</h4>
                        </div>
                        <div class="page-wraper">
                            <div class="page-content bg-white">
                                <div class="content-block">
                                    <div class="section-area section-sp1 gallery-bx">
                                        <div class="container">
                                            <div class="clearfix">
                                                <ul id="masonry" class="ttr-gallery-listing magnific-image row" style="list-style: none;">
                                                    <?php $sql = "SELECT * FROM event ORDER BY event_created_at DESC"; ?>
                                                    <?php $stmt = $con->query($sql)->fetchAll(); ?>
                                                    <?php if ($stmt) : ?>
                                                        <?php foreach ($stmt as $row) : ?>
                                                            <li class="action-card col-lg-6 col-md-6 col-sm-12 happening">
                                                                <div class="event-bx m-b30">
                                                                    <div class="action-box">
                                                                        <?php if ($row['event_image'] == null) : ?>
                                                                            <img src="/public/admin/assets/images/background/bg1.jpg" style="height: 250px">
                                                                        <?php else : ?>
                                                                            <img src="/public/event_images/<?php echo $row['event_image']; ?>" style="height: 250px">
                                                                        <?php endif; ?>
                                                                    </div>
                                                                    <div class="info-bx d-flex">
                                                                        <div class="event-info">
                                                                            <h4 class="event-title"><a href="event_in_details.php?details=<?php echo $hash->hash($row['event_id'], 10); ?>"><?php echo $row['event_title']; ?></a></h4>
                                                                            <ul class="media-post">
                                                                                <li><a href="#"><i class="fa fa-clock-o"></i><?php echo $helper->customDateFormat($row['event_created_at']); ?></a></li>
                                                                            </ul>
                                                                            <p><?php echo substr($row['event_description'], 0, 50) ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <li class="action-card col-lg-6 col-md-6 col-sm-12 happening">
                                                            <div class="event-bx m-b30">
                                                                <div class="action-box">
                                                                    <img src="/public/admin/assets/images/background/bg1.jpg" style="height: 250px">
                                                                </div>
                                                                <div class="info-bx d-flex">

                                                                    <div class="event-info">
                                                                        <h4 class="event-title"><a href="#">Education Autumn Tour 2019</a></h4>
                                                                        <ul class="media-post">
                                                                            <li><a href="#"><i class="fa fa-clock-o"></i> 7:00am 8:00am</a></li>
                                                                            <li><a href="#"><i class="fa fa-map-marker"></i> Berlin, Germany</a></li>
                                                                        </ul>
                                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the..</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="action-card col-lg-6 col-md-6 col-sm-12 happening">
                                                            <div class="event-bx m-b30">
                                                                <div class="action-box">
                                                                    <img src="/public/admin/assets/images/background/bg1.jpg" style="height: 250px">
                                                                </div>
                                                                <div class="info-bx d-flex">
                                                                    <div>
                                                                        <div class="event-time">
                                                                            <div class="event-date">29</div>
                                                                            <div class="event-month">October</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="event-info">
                                                                        <h4 class="event-title"><a href="#">Education Autumn Tour 2019</a></h4>
                                                                        <ul class="media-post">
                                                                            <li><a href="#"><i class="fa fa-clock-o"></i> 7:00am 8:00am</a></li>
                                                                            <li><a href="#"><i class="fa fa-map-marker"></i> Berlin, Germany</a></li>
                                                                        </ul>
                                                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the..</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endif; ?>
                                                    <!-- end fetch events -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php endif; ?>
</main>
<?php require_once __DIR__ . '/../include/footer.php'; ?>