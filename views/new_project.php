<?php include_once 'elements/header.php'; ?>
<!--this screen the user is not logged in-->
<div id="new_project" class="row">
    <div class="small-12 columns">
        <h2>new project</h2>
        <form> 
            <div class="row"> 
                <div class="small-8 columns"> 
                    <div class="row"> 
                        <div class="small-3 columns"> 
                            <label for="name" class="right inline">Project Name</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <input type="text" name="name" placeholder="project name" required/> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="small-3 columns"> 
                            <label for="description" class="right inline">Description</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <textarea name="description" placeholder="optional description"></textarea>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="small-9 columns small-offset-3">
                            <button type="button" class="add-project button radius">add project</button> 
                        </div>
                    </div>
                </div> 
            </div> 
        </form>
    </div>
</div>
<?php include_once 'elements/footer.php'; ?>
