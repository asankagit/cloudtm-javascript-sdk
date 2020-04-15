<div class="row-fluid">
    <div class="span3">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-pencil"></i>
                </span>
                <h5>Response</h5>
            </div>
            <div class="widget-content nopadding alert alert-success">
                <table class="table table-striped">
                    <tr>
                        <td>siteId</td>
                        <td><?php echo $response->siteId; ?></td>
                    </tr>
                    <tr>
                        <td>siteName</td>
                        <td><?php echo $response->siteName; ?></td>
                    </tr>
                    <tr>
                        <td>message</td>
                        <td><?php echo $response->message; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="span9">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-pencil"></i>
                </span>
                <h5>Please Add following Script to your website</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $script; ?>
            </div>
        </div>
    </div>
</div>