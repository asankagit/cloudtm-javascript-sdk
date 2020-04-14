<div class="row-fluid">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-pencil"></i>
                </span>
                <h5>Add new site</h5>
            </div>
            <div class="widget-content nopadding">
                <form id="form-wizard" class="form-horizontal" method="post" action="<?php echo base_url()."sites/add"; ?>">
                    <div id="form-wizard-1" class="step pull-left"  style="width:100%;">
                        <div class="control-group">
                            <label class="control-label">Website Name</label>
                            <div class="controls">
                                <input id="username" type="text" required name="webname" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Website URL</label>
                            <div class="controls">
                                <input id="username" type="text" required name="weburl" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Website Description</label>
                            <div class="controls">
                                <textarea name="webdesc"></textarea>
                            </div>
                        </div>
                    </div>   
                    <div class="clearfix"></div>
                    <div class="form-actions">
                        <input id="back" class="btn btn-primary" type="reset" value="Reset" />
                        <input id="next" name="generate" class="btn btn-primary" type="submit" value="Generate" />
                        <div id="status"></div>
                    </div>
                    <div id="submitted"></div>
                </form>

            </div>
        </div>
    </div>
</div>