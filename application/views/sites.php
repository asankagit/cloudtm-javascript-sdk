<div class="row-fluid">

        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-file"></i></span>
                <h5>All Sites</h5>
                <a href="<?php echo base_url()."sites/add"; ?>" class="pull-right btn btn-info" >Add Site</a>
            </div>
            <div class="widget-content nopadding">
                <?php if(isset($sites)&&!empty($sites)&& sizeof($sites)>0){ ?>
                <ul class="recent-posts">     
                    <?php foreach ($sites as $key => $site) { ?>
                    <li>
                        <div class="user-thumb"> <img width="40" height="40" alt="User" src="<?php echo base_url(); ?>resources/img/demo/av1.jpg"> </div>
                        <div class="article-post">
                            <div class="fr"><a href="<?php echo base_url()."sites/details/".$site->siteId; ?>" class="btn btn-primary btn-mini" >view more</a></div>
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
                        <div class="clearfix"></div>
                    </li>
                    <?php } ?>
                </ul> 
                <?php } else { ?>
                <div class="alert alert-warning" style="margin:30px 10px;">No results found!</div>
                <?php }  ?>
            </div>
    </div>
</div> 