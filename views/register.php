<?php include_once 'elements/header.php'; ?>
<!--this screen the user is not logged in-->
<div id="register" class="row">
    <div class="small-12 columns">
        <h2>register</h2>
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
                            <label for="email" class="right inline">Email</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <input type="text" name="email" placeholder="email" required/> 
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
                        <div class="small-3 columns"> 
                            <label for="confirm_password" class="right inline">Confirm Password</label> 
                        </div> 
                        <div class="small-9 columns"> 
                            <input type="password" name="confirm_password" placeholder="confirm password" required/> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="small-9 columns small-offset-3">
                            <button type="button" class="create-account button radius">create account</button> 
                            <br /><a href="/index.php">sign in</a>
                        </div>
                    </div>
                </div> 
            </div> 
        </form>
    </div>
</div>
<?php include_once 'elements/footer.php'; ?>
