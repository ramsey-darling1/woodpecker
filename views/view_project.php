<?php include_once 'elements/header.php'; ?>
<div id="view_project" class="row">
    <div class="small-12 columns">
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
                    <div class="project-hours-wrap">
                        <?php if(!empty($project_hours)): ?>
                            <div class="row">
                                <div class="small-12 columns">
                                    <h3>Project Hours</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="small-6 columns">
                                    <h4>Date Recorded</h4>
                                </div>
                                <div class="small-6 columns">
                                    <h4>Hours Recorded</h4>
                                </div>
                            </div>
                            <?php foreach($project_hours as $ph): ?>
                                <div class="row project-hours">
                                    <div class="small-6 columns"> 
                                        <p><?php echo !empty($ph['date_recorded']) ? date('m/d/y',$ph['date_recorded']) : 'N/A'; ?></p>
                                    </div> 
                                    <div class="small-6 columns"> 
                                        <p><?php echo !empty($ph['amount']) ? $ph['amount'] : null; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
                            <input type="text" name="date" class="fdatepicker" placeholder="date" required/> 
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
                            <button type="button" 
                                    class="record-hours button radius" 
                                    data-pid="<?php echo !empty($project_data['pid']) ? $project_data['pid'] : null; ?>">
                                    record
                            </button> 
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
