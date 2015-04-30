<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo Yii::app()->createUrl("backend"); ?>"><i class="icon-home icon-white"></i> <?php echo Yii::app()->name; ?></a>
            <ul class="nav user_menu pull-right">
               <!-- <li class="hidden-phone hidden-tablet">
                    <div class="nb_boxes clearfix">
                        <a data-toggle="modal" data-backdrop="static" href="#myMail" class="label ttip_b" title="New messages">25 <i class="splashy-mail_light"></i></a>
                        <a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="New tasks">10 <i class="splashy-calendar_week"></i></a>
                    </div>
                </li>
                <li class="divider-vertical hidden-phone hidden-tablet"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle nav_condensed" data-toggle="dropdown"><i class="flag-gb"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)"><i class="flag-de"></i> Deutsch</a></li>
                        <li><a href="javascript:void(0)"><i class="flag-fr"></i> Français</a></li>
                        <li><a href="javascript:void(0)"><i class="flag-es"></i> Español</a></li>
                        <li><a href="javascript:void(0)"><i class="flag-ru"></i> Pусский</a></li>
                    </ul>
                </li>
                <li class="divider-vertical hidden-phone hidden-tablet"></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->name; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo Yii::app()->createUrl("backend/user/view",array('id'=>Yii::app()->user->id)); ?>">My Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo Yii::app()->createUrl("backend/default/logout"); ?>">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
                <span class="icon-align-justify icon-white"></span>
            </a>
            <?php $this->widget('MainMenu'); ?>
        </div>
    </div>
</div>
<!--<div class="modal hide fade" id="myMail">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>New messages</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
        <table class="table table-condensed table-striped" data-rowlink="a">
            <thead>
            <tr>
                <th>Sender</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Size</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Declan Pamphlett</td>
                <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                <td>23/05/2012</td>
                <td>25KB</td>
            </tr>
            <tr>
                <td>Erin Church</td>
                <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                <td>24/05/2012</td>
                <td>15KB</td>
            </tr>
            <tr>
                <td>Koby Auld</td>
                <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                <td>25/05/2012</td>
                <td>28KB</td>
            </tr>
            <tr>
                <td>Anthony Pound</td>
                <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                <td>25/05/2012</td>
                <td>33KB</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="btn">Go to mailbox</a>
    </div>
</div>
<div class="modal hide fade" id="myTasks">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>New Tasks</h3>
    </div>
    <div class="modal-body">
        <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
        <table class="table table-condensed table-striped" data-rowlink="a">
            <thead>
            <tr>
                <th>id</th>
                <th>Summary</th>
                <th>Updated</th>
                <th>Priority</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>P-23</td>
                <td><a href="javascript:void(0)">Admin should not break if URL&hellip;</a></td>
                <td>23/05/2012</td>
                <td class="tac"><span class="label label-important">High</span></td>
                <td>Open</td>
            </tr>
            <tr>
                <td>P-18</td>
                <td><a href="javascript:void(0)">Displaying submenus in custom&hellip;</a></td>
                <td>22/05/2012</td>
                <td class="tac"><span class="label label-warning">Medium</span></td>
                <td>Reopen</td>
            </tr>
            <tr>
                <td>P-25</td>
                <td><a href="javascript:void(0)">Featured image on post types&hellip;</a></td>
                <td>22/05/2012</td>
                <td class="tac"><span class="label label-success">Low</span></td>
                <td>Updated</td>
            </tr>
            <tr>
                <td>P-10</td>
                <td><a href="javascript:void(0)">Multiple feed fixes and&hellip;</a></td>
                <td>17/05/2012</td>
                <td class="tac"><span class="label label-warning">Medium</span></td>
                <td>Open</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="btn">Go to task manager</a>
    </div>
</div>       -->