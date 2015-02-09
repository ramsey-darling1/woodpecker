<?php include_once 'elements/header.php'; ?>
<div id="list_projects" class="row">
    <div class="small-12 columns">
        <h2>all projects</h2>
            <div class="row projects-wrap"> 
                <div class="small-8 columns"> 
                    <?php if(!empty($projects_list)): ?>
                    <?php foreach($projects_list as $project): ?>
                    <div class="row" data-pid="<?php echo !empty($project['pid']) ? $project['pid'] : null; ?>"> 
                        <div class="small-3 columns"> 
                        <h3><?php echo !empty($project['name']) ? $project['name'] : 'N/A'; ?></h3>
                        </div> 
                        <div class="small-9 columns"> 
                        <p><?php echo !empty($project['description']) ? $project['description'] : null; ?></p>
                        </div> 
                    </div> 
                    <?php endforeach; ?> 
                    <?php else:?>
                        <div data-alert class="alert-box warning radius">There are no active projects</div>
                    <?php endif; ?>
                </div> 
            </div> 
    </div>
</div>
<?php include_once 'elements/footer.php'; ?>
