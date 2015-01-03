<?php include_once 'elements/header.php'; ?>
<!--this screen the user is not logged in-->
<div id="login" class="row">
    <div class="small-12 columns">
        <h2>please login</h2>
        <form> 
            <div class="row"> 
                <div class="small-8 columns"> 
                    <div class="row"> 
                        <div class="small-3 columns"> 
                            <label for="username" class="right inline">Username</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <input type="text" name="username" placeholder="username" required/> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="small-3 columns"> 
                            <label for="password" class="right inline">Password</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <input type="password" name="password" placeholder="password" required/> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="small-9 columns small-offset-3">
                            <button type="button" class="login button radius">login</button> 
                        </div>
                    </div>
                </div> 
            </div> 
        </form>
    </div>
</div>
<?php include_once 'elements/footer.php'; ?>
