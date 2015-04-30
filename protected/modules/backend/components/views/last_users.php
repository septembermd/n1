<?php
/**
 * .
 * Date: 10/1/12
 * Time: 5:59 PM
 */
?>

<div class="span12" id="user-list">
    <h3 class="heading">Users
        <small>last 24 hours</small>
    </h3>
    <div class="row-fluid">
        <div class="input-prepend">
            <span class="add-on ad-on-icon"><i class="icon-user"></i></span><input type="text"
                                                                                   class="user-list-search search"
                                                                                   placeholder="Search user"/>
        </div>
        <ul class="nav nav-pills line_sep">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Sort by <b class="caret"></b></a>
                <ul class="dropdown-menu sort-by">
                    <li><a href="javascript:void(0)" class="sort" data-sort="sl_name">by name</a></li>
                    <li><a href="javascript:void(0)" class="sort" data-sort="sl_status">by status</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Show <b class="caret"></b></a>
                <ul class="dropdown-menu filter">
                    <li class="active"><a href="javascript:void(0)" id="filter-none">All</a></li>
                    <li><a href="javascript:void(0)" id="filter-online">Online</a></li>
                    <li><a href="javascript:void(0)" id="filter-offline">Offline</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <ul class="list user_list">

        <?php foreach ($users as $user) { ?>
        <li>
            <?php if ($user->isUserOnline) { ?>
            <span class="label label-success pull-right sl_status">online</span>
            <?php }else{ ?>
            <span class="label label-important pull-right sl_status">offline</span>
            <?php } ?>
            <a href="<?php echo Yii::app()->createUrl("backend/user/view",array('id'=>$user->id)); ?>" class="sl_name"><?php echo $user->name; ?></a><br/>
            <small class="s_color sl_email"><?php echo $user->email; ?></small>
        </li>
        <?php } ?>
    </ul>
    <div class="pagination">
        <ul class="paging bottomPaging"></ul>
    </div>
</div>