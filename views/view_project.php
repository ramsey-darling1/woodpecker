<?php include_once 'elements/header.php'; ?>
<div id="view_project" class="row">
    <div class="small-12 columns">
        <h2>view project</h2>
            <div class="row project-wrap"> 
                <div class="small-8 columns"> 
                    <?php if(!empty($project_data)): ?>
                    <div class="row"> 
                        <div class="small-3 columns"> 
                        <h3><?php echo !empty($project_data['name']) ? $project_data['name'] : 'N/A'; ?></h3>
                        </div> 
                        <div class="small-9 columns"> 
                        <p><?php echo !empty($project_data['description']) ? $project_data['description'] : null; ?></p>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="small-12 columns">
                            <h3>Record Hours</h3>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="small-3 columns"> 
                            <label for="date" class="right inline">Date</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <input type="text" name="date" placeholder="date" required/> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="small-3 columns"> 
                            <label for="hours" class="right inline">Hours</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <input type="text" name="hours" placeholder="hours" required/> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="small-9 columns small-offset-3">
                            <button type="button" class="record-hours button radius">record</button> 
                        </div>
                    </div>
                    <?php else:?>
                        <div data-alert class="alert-box warning radius">Project not found</div>
                    <?php endif; ?>
                </div> 
            </div> 
    </div>
</div>
<?php include_once 'elements/footer.php'; ?>
