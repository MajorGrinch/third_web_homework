<base href="<?php echo base_url(); ?>" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <title>Crown - premium responsive admin template for backend systems</title>
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    

    <!-- Shared on MafiaShare.net  --><!-- Shared on MafiaShare.net  --></head>

<body>

<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><img src="images/logo.png" alt="" /></div>

    <div class="sidebarSep mt0"></div>

    <!-- Search widget -->
    <form action="index.php/test/search" class="sidebarSearch" method="post">
        <input type="text" name="search" placeholder="search..." id="ac" />
        <input type="submit" value="" />
    </form>

    <div class="sidebarSep"></div>

    <!-- General balance widget -->
    <div class="genBalance">
        <a  title="" class="amount">
            <span>Your current project:</span>
            <span class="balanceAmount"><?php echo $_SESSION['prj']; ?></span>
        </a>
        <!--<a href="#" title="" class="amChanges">
            <strong class="sPositive">+0.6%</strong>
        </a>-->
    </div>

    <!-- Next update progress widget -->
    <div class="nextUpdate">
        <ul>
            <li>Your current progress:</li>
            <li>23 hrs 14 min</li>
        </ul>
        <div class="pWrapper"><div class="progressG" title="<?php echo $_SESSION['progress']?>%"></div></div>
    </div>

    <div class="sidebarSep"></div>

    <!-- Left navigation -->
    <ul id="menu" class="nav">
        <li class="dash"><a href="index.php/test/myproject" title="" class="active"><span>我的项目</span></a></li>
        <li class="charts"><a href="index.php/test/log_page" title=""><span>提交工作日志</span></a></li>
        <li class="forms"><a href="#" title="" class="exp"><span>项目管理</span><strong>3</strong></a>
            <ul class="sub">
                <li><a href="index.php/test/up_begin_page" title="">提交开题报告</a></li>
                <li><a href="index.php/test/up_mid_page" title="">提交中期报告</a></li>
                <li><a href="index.php/test/up_final_page" title="">提交结题报告</a></li>
            </ul>
        </li>
    </ul>
</div>


<!-- Right side -->
<div id="rightSide">

    <!-- Top fixed navigation -->
    <div class="topNav">
        <div class="wrapper">
            <div class="welcome"><a href="#" title=""><img src="images/userPic.png" alt="" /></a><span>Hello, <?php echo $_SESSION['name'] , ' 您是'.$_SESSION['type']; ?>!</span></div>
            <div class="userNav">
                <ul>
                    <li><a href="#" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Profile</span></a></li>
                    <li><a href="#" title=""><img src="images/icons/topnav/tasks.png" alt="" /><span>Tasks</span></a></li>
                    <li class="dd"><a title=""><img src="images/icons/topnav/messages.png" alt="" /><span>Messages</span><span class="numberTop">8</span></a>
                        <ul class="userDropdown">
                            <li><a href="#" title="" class="sAdd">new message</a></li>
                            <li><a href="#" title="" class="sInbox">inbox</a></li>
                            <li><a href="#" title="" class="sOutbox">outbox</a></li>
                            <li><a href="#" title="" class="sTrash">trash</a></li>
                        </ul>
                    </li>
                    <li><a href="#" title=""><img src="images/icons/topnav/settings.png" alt="" /><span>Settings</span></a></li>
                    <li><a href="index.php/test/logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    

    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">

            <div class="middleNav">
                <ul>
                    <li class="mUser"><a title=""><span class="users"></span></a>
                        <ul class="mSub1">
                            <li><a href="#" title="">Add user</a></li>
                            <li><a href="#" title="">Statistics</a></li>
                            <li><a href="#" title="">Orders</a></li>
                        </ul>
                    </li>
                    <li class="mMessages"><a title=""><span class="messages"></span></a>
                        <ul class="mSub2">
                            <li><a href="#" title="">New tickets<span class="numberRight">8</span></a></li>
                            <li><a href="#" title="">Pending tickets<span class="numberRight">12</span></a></li>
                            <li><a href="#" title="">Closed tickets</a></li>
                        </ul>
                    </li>
                    <li class="mFiles"><a href="#" title="Or you can use a tooltip" class="tipN"><span class="files"></span></a></li>
                    <li class="mOrders"><a title=""><span class="orders"></span><span class="numberMiddle">8</span></a>
                        <ul class="mSub4">
                            <li><a href="#" title="">Pending uploads</a></li>
                            <li><a href="#" title="">Statistics</a></li>
                            <li><a href="#" title="">Trash</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>