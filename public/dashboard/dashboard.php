<?php require_once __DIR__ . '/../include/header.php'; ?>
<?php
// disable user
if (
    isset($_GET['status']) && $_GET['status'] != ''
    && isset($_GET['id']) && $_GET['id'] > 0
) {

    $status = $_GET['status'];
    $status_id = $_GET['id'];
    if ($status == "Active") {
        $status = 1;
    } else {
        $status = 0;
    }
    $sql = "UPDATE users SET status = ? WHERE id = ?";
    $con->prepare($sql)->execute([$status, $status_id]);
    echo "<script>window.location = 'dashboard.php';</script>";
}
// end
?>
<!-- Left sidebar menu start -->
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
                <?php if ($_SESSION['user_role_id'] == 0) : ?>
                    <li>
                        <a href="certificates.php" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-user"></i></span>
                            <span class="ttr-label">Certificates</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="profile.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-user"></i></span>
                        <span class="ttr-label">My Profile</span>
                    </a>
                </li>

                <li class="ttr-seperate"></li>
            </ul>
            <!-- sidebar menu end -->
        </nav>
        <!-- sidebar menu end -->
    </div>
</div>
<!-- Left sidebar menu end -->
<!-- end  -->




<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        <!-- card header -->
        <?php require_once __DIR__ . '/../include/card_header.php'; ?>
        <!-- Card header end -->
        <?php if ($_SESSION['user_role_id'] == 0) : ?>
            <di class="row">
                <div class="col-lg-12  m-b30">
                    <a href="make_event.php" class="btn button" id="make_new_eventBtn">+ add Event</a>
                    <a href="posts.php" class="btn button" id="make_new_eventBtn">+ add Post</a>
                </div>
            </di>
        <?php endif; ?>
        <div class="row">
            <!-- user table starts -->
            <div class="col-lg-12 m-b30">
                <div class="widget-box">
                    <div class="widget-inner">
                        <?php displayMessage(); ?>

                        <table class="table card-text">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <?php if ($_SESSION['user_role_id'] == 0) : ?>
                                        <th>Email</th>
                                        <th>Delete</th>
                                        <th>Status</th>
                                    <?php else : ?>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (($_SESSION['user_role_id']) == 0) {
                                    $stmt = $con->prepare("SELECT * FROM users");
                                } else {
                                    $stmt = $con->prepare("SELECT * FROM users WHERE id = $user_id  ORDER BY created_at");
                                }
                                $stmt->execute();
                                foreach ($stmt as $result) {
                                ?>
                                    <tr>
                                        <td><?php echo $result['name']; ?></td>
                                        <td> <?php echo $result['email']; ?></td>
                                        <?php if ($_SESSION['user_role_id'] == 0) : ?>
                                            <?php if ($result['role_id'] == 0) : ?>
                                            <?php else : ?>
                                                <td>
                                                    <a href="/app/post_crud/deleteUser.php?id=<?php echo base64_encode($result['id']); ?>" class="btn  button-sm   btn-danger btn-sm">Delete</a>
                                                </td>
                                            <?php endif; ?>
                                            <?php
                                            $status = "Active";
                                            $strStatus = "Deactive";
                                            if ($result['status'] == 1) {
                                                $status = "Deactive";
                                                $strStatus = "Active";
                                            }
                                            ?>
                                            <?php if ($result['role_id'] == 0) : ?>
                                            <?php else : ?>
                                                <td>
                                                    <a href="?id=<?php echo $result['id']; ?>&status=<?php echo $status; ?>" class="btn  button-sm  btn-primary btn-sm">
                                                        <?php echo $strStatus; ?>
                                                    </a>
                                                </td>
                                            <?php endif; ?>
                                        <?php else : ?>
                                        <?php endif; ?>
                                    <tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- sold item table -->
            <?php if ($_SESSION['user_role_id'] == 0) : ?>
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <h5 style="padding: 10px; margin-left: 5px;">Pending Courses</h5>
                        <div class="widget-inner">
                            <?php displayMessage(); ?>
                            <table class="table card-text">
                                <thead>
                                    <th>Post token</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                </thead>
                                <?php if (is_array($sold_course) || is_object($sold_course)) : ?>
                                    <?php foreach ($sold_course as $course) : ?>
                                        <tbody>
                                            <td> <?php echo $course['token']; ?></td>
                                            <td>
                                                <?php if ($course['image'] ==  null) : ?>
                                                    <a href="/public/profile_image/placeholder.png" target="_blank"><img src="/public/profile_image/placeholder.png" style="width: 50px; height:50px; border-radius: 50%;"></a>
                                                <?php else : ?>
                                                    <a href="/public/payment_image/<?php echo $course['image'] ?? null; ?>" target="_blank">
                                                        <img src="/public/payment_image/<?php echo $course['image'] ?? null; ?>" style="width: 50px; height:50px; border-radius: 50%;">
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php if ($course['status'] == 0) : ?>
                                                    <button class="btn button-sm btn-primary btn-sm approveBtn" id="<?php echo $course['id'] ?>">Pending</button>
                                                <?php else : ?>
                                                    <button class="btn  button-sm  btn-primary btn-sm">Approved</button>
                                                <?php endif; ?>
                                            </td>
                                        </tbody>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- event payment table -->
            <!-- sold item table -->
            <?php if ($_SESSION['user_role_id'] == 0) : ?>
                <div class="col-lg-12 m-b30">
                    <div class="widget-box">
                        <h5 style="padding: 10px; margin-left: 5px;">Pending Events</h5>
                        <div class="widget-inner">
                            <?php displayMessage(); ?>
                            <table class="table card-text">
                                <thead>
                                    <th>Name</th>
                                    <th>Event Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                </thead>
                                <?php if (is_array($join_event) || is_object($join_event)) : ?>
                                    <?php foreach ($join_event as $event) : ?>
                                        <tbody>
                                            <td> <?php echo $event['name']; ?></td>
                                            <td> <?php echo $event['event_title']; ?></td>
                                            <td>
                                                <?php if ($event['join_event_image'] ==  null) : ?>
                                                    <a href="/public/profile_image/placeholder.png" target="_blank"><img src="/public/profile_image/placeholder.png" style="width: 50px; height:50px; border-radius: 50%;"></a>
                                                <?php else : ?>
                                                    <a href="/public/join_event_image/<?php echo $event['join_event_image']; ?>" target="_blank">
                                                        <img src="/public/join_event_image/<?php echo $event['join_event_image']; ?>" style="width: 50px; height:50px; border-radius: 50%;">
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php if ($event['event_status'] == 0) : ?>
                                                    <button class="btn button-sm btn-primary btn-sm approve_eventBtn" id="<?php echo $event['join_event_id'] ?>">Pending</button>
                                                <?php else : ?>
                                                    <button class="btn  button-sm  btn-primary btn-sm">Approved</button>
                                                <?php endif; ?>
                                            </td>
                                        </tbody>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/../include/footer.php'; ?>