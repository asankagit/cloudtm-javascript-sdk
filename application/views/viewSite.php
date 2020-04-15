<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-file"></i>
                </span>
                <h5>Basic Details</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-striped" style="width:90%;">
                    <tr>
                        <td style="width:10%;"><span class="user-info">Id</span></td>
                        <td style="width:5%;">:</td>
                        <td style="width:85%;"><span class="text-info"><?php echo $site->siteId; ?></span></td>
                    </tr>
                    <tr>
                        <td><span class="user-info">Site Name</span></td>
                        <td>:</td>                                    
                        <td><span class="text-info"><?php echo $site->siteName; ?></span></td>
                    </tr>
                    <tr>
                        <td><span class="user-info">Domain</span></td>
                        <td>:</td>                                    
                        <td><span class="text-info"><?php echo $site->domain; ?></span></td>
                    </tr>
                    <tr>
                        <td><span class="user-info">Description</span></td>
                        <td>:</td>                                    
                        <td><span class="text-info"><?php echo $site->description; ?></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-eye-open"></i>
                </span>
                <h5>Visitor statistics</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Number of visitors</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><?php echo (isset($visitors->visitorDetails)) ? sizeof($visitors->visitorDetails) : 0; ?></td>
                            <td><a href="#myModal" data-toggle="modal" class="btn btn-success">View details</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-arrow-right"></i>
                </span>
                <h5>Scroll Summary</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if(isset($scrolls->scrollSummary)&&!empty($scrolls->scrollSummary)&& sizeof($scrolls->scrollSummary)>0){ ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Range</th>
                            <th>count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($scrolls->scrollSummary as $scrol){ ?>
                        <tr>
                            <td><?php echo $scrol->lb; ?> ~ <?php echo $scrol->ub; ?></td>
                            <td><?php echo $scrol->count; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } else {
                    echo '<div class="alert alert-warning" style="margin:30px 10px;">No results found!</div>';
                } ?>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-file"></i>
                </span>
                <h5>Bucket Details</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Total Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><?php echo (isset($streams)) ? sizeof($streams) : 0; ?></td>
                            <td><a href="#stream" data-toggle="modal" class="btn btn-success">View details</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>

<div id="myModal" class="modal hide modal-lg" style="width:70%; left:30%;">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3>Visitors Details</h3>
    </div>
    <div class="modal-body">
        <?php if(isset($visitors->visitorDetails)&&!empty($visitors->visitorDetails)&& sizeof($visitors->visitorDetails)>0){ ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Visitor Id</th>
                    <th>Source IP</th>
                    <th>User Agent</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($visitors->visitorDetails as $visitor){ ?>
                <tr>
                    <td><?php echo $visitor->visitorId; ?></td>
                    <td><?php echo $visitor->sourceIp; ?></td>
                    <td><?php echo $visitor->userAgent; ?></td>
                    <td><?php echo $visitor->time; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else {
            echo '<div class="alert alert-warning" style="margin:30px 10px;">No results found!</div>';
        } ?>
    </div>
</div>


<div id="stream" class="modal hide modal-lg" style="width:70%; left:30%;">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3>Scroll Details</h3>
    </div>
    <div class="modal-body">
        <?php if(isset($streams)&&!empty($streams)&& sizeof($streams)>0){ ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Count</th>
                    
                    <th>Bucket ID</th>
                    <th>Bucket Item</th>
                    <th>Event Type</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($streams as $stream){ ?>
                <tr>
                    <td><?php echo $stream->ITEM_COUNT; ?></td>
                    
                    <td><?php echo $stream->BASKET_ID; ?></td>
                    <td><?php echo $stream->BASKET_ITEM; ?></td>
                    <td><?php echo $stream->EVENT_TYPE; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } else {
            echo '<div class="alert alert-warning" style="margin:30px 10px;">No results found!</div>';
        } ?>
    </div>
</div>