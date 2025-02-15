<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inbox</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
</head>

<body ondragstart="return false;" ondrop="return false;">
    <?php
    include './partials/header-inbox.php';
    ?>

    <main class="mainbox">
        <div class="box">
            <?php
            include './partials/list-friend.php';
            ?>

            <!--  -->
            <?php
            $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
            if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
            } else {
                header("location: inbox.php");
            }
            ?>
            <!--  -->

            <div class="box-chat-friend-select">
                <div class="name-friend">
                    <div class="avatar-and-name-user">
                        <a href="#"><img src="php/images/<?php echo $row['img'];  ?>" alt=""></a>
                        <a href="#">
                            <h5><?php echo $row['username'] ?></h5>
                        </a>
                    </div>
                    <div class="info">
                        <a href="#">
                            <svg color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
                                <circle cx="12.001" cy="12.005" fill="none" r="10.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle>
                                <circle cx="11.819" cy="7.709" r="1.25"></circle>
                                <line fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="10.569" x2="13.432" y1="16.777" y2="16.777"></line>
                                <polyline fill="none" points="10.569 11.05 12 11.05 12 16.777" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="box-show-mess">
                    <div id="chatBox" class="chat-box">

                    </div>
                </div>
                <div class="input-mess">
                    <form action="#" class="input">
                        <button>
                            <div class="new-mess">
                                <svg color="#262626" fill="#262626" height="24" role="img" viewBox="0 0 24 24" width="24">
                                    <path d="M15.83 10.997a1.167 1.167 0 101.167 1.167 1.167 1.167 0 00-1.167-1.167zm-6.5 1.167a1.167 1.167 0 10-1.166 1.167 1.167 1.167 0 001.166-1.167zm5.163 3.24a3.406 3.406 0 01-4.982.007 1 1 0 10-1.557 1.256 5.397 5.397 0 008.09 0 1 1 0 00-1.55-1.263zM12 .503a11.5 11.5 0 1011.5 11.5A11.513 11.513 0 0012 .503zm0 21a9.5 9.5 0 119.5-9.5 9.51 9.51 0 01-9.5 9.5z">
                                    </path>
                                </svg>
                            </div>
                        </button>
                        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                        <input id="type-mess" type="text " name="message" class="input-field" onkeyup="success()" placeholder="Nhắn tin... " autocomplete="off">
                        <div class="right-button-input ">
                            <button id="image-button">
                                <div class="new-mess ">
                                    <svg color="#262626 " fill="#262626 " height="24 " role="img " viewBox="0 0 24 24 " width="24 ">
                                        <path d="M6.549 5.013A1.557 1.557 0 108.106 6.57a1.557 1.557 0 00-1.557-1.557z " fill-rule="evenodd "></path>
                                        <path d="M2 18.605l3.901-3.9a.908.908 0 011.284 0l2.807 2.806a.908.908 0 001.283 0l5.534-5.534a.908.908 0 011.283 0l3.905 3.905 " fill="none " stroke="currentColor " stroke-linejoin="round " stroke-width="2 ">
                                        </path>
                                        <path d="M18.44 2.004A3.56 3.56 0 0122 5.564h0v12.873a3.56 3.56 0 01-3.56 3.56H5.568a3.56 3.56 0 01-3.56-3.56V5.563a3.56 3.56 0 013.56-3.56z " fill="none " stroke="currentColor " stroke-linecap="round " stroke-linejoin="round " stroke-width="2 "></path>
                                    </svg>
                                </div>
                            </button>
                            <button id="like-button">
                                <div class="new-mess ">
                                    <svg color="#262626 " fill="#262626 " height="24 " role="img " viewBox="0 0 24 24 " width="24 ">
                                        <path d="M16.792 3.904A4.989 4.989 0 0121.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 014.708-5.218
                                            4.21 4.21 0 013.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 013.679-1.938m0-2a6.04 6.04 0 00-4.797 2.127 6.052 6.052 0 00-4.787-2.127A6.985 6.985 0 00.5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998
                                            44.998 0 003.518 3.018 2 2 0 002.174 0 45.263 45.263 0 003.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 00-6.708-7.218z ">
                                        </path>
                                    </svg>
                                </div>
                            </button>
                            <button id="send-button" class="send-btn">
                                <div class="new-mess ">
                                    <h2>Gửi</h2>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="JS/users.js"></script>
    <script src="JS/chat.js"></script>

</body>

</html>