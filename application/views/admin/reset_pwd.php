<h1>Reset password</h1>
<?php

echo validation_errors();
if(!isset($mess)){
    $mess = "Change password for " . $result['fname']. " " . $result['lname']." with Login name ".$result['loginname'];
}
?>
<h3><?php echo $mess?></h3>
<form name="edituser" method="post" action="/admin/user/reset_pwd">
    <div class="row form-group" >
        <div class="col-sm-2">
            <label for="passwd">New password: </label>

        </div>
        <div class="col-sm-2">
            <input type="password" id="passwd" class="form-control" name="passwd" required>
            <input type="hidden" name="mess" value="<?php echo $mess; ?>">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="confpwd">Confirm password: </label>

        </div>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="confpwd" name="confpwd" required>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-2">
            <input type="hidden" name="id" value="<?php if(isset($result))
            {
                echo $result['id'];
            }else{
                echo set_value('id');
            }
            ?>">
         
            
        </div>
        <div class="col-sm-2"><button type="submit" class="btn btn-success">Update</button>
            <a href="/admin/admin_view" class="btn btn-default">Cancel</a></div>
    </div>

</form>
