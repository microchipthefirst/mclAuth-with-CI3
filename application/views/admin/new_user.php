<h1>Create a new user</h1>
<?php
echo validation_errors();
?>
<form name="createuser" method="post" action="/admin/user/new_user">
    <div class="row form-group" >
        <div class="col-sm-2">
            <label for="fname">First name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="fname" value="<?php echo set_value('fname') ?>" required>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="lname">Last name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="lname" value="<?php echo set_value('lname') ?>" required="">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="loginname">Login name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="loginname" value="<?php echo set_value('loginname') ?>" required="">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="passwd">Password: </label>

        </div>
        <div class="col-sm-2">
            <input type="password" class="form-control" name="passwd" required="">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="confpwd">Confirm password: </label>

        </div>
        <div class="col-sm-2">
            <input type="password" class="form-control" name="confpwd" required="">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="group">Group: </label>

        </div>
        <div class="col-sm-2">
            <?php 
            if(isset($group)){
                echo $group; 
            }else{
                echo set_value('group');
            }
            
            ?>
            <!--<input type="text" class="form-control" name="group" value="" required="">-->
            <!--to be altered to selection box-->
        </div>
    </div><div class="row form-group">
        <div class="col-sm-2">
            <label for="email">E-mail: </label>

        </div>
        <div class="col-sm-2">
            <input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>" required="">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            

        </div>
        <div class="col-sm-5">
            You will need to activate this user before logon.
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2"><button type="submit" class="btn btn-success">Create</button>
        <a href="/admin/admin_view" class="btn btn-default">Cancel</a></div>
    </div>

</form>