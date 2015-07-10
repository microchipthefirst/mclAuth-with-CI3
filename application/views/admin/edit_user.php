<h1>Edit a user</h1>
<?php
echo validation_errors();
?>
<form name="edituser" method="post" action="/admin/user/edit">
    <div class="row form-group" >
        <div class="col-sm-2">
            <label for="fname">First name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="fname" value="<?php 
            if(isset($result))
            {
                echo $result['fname'];
            }else{
                echo set_value('fname');
            }
            
                ?>" required>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="lname">Last name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="lname" value="<?php if(isset($result))
            {
                echo $result['lname'];
            }else{
                echo set_value('lname');
            }
            ?>" required="">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="loginname">Login name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="loginname" value="<?php 
            if(isset($result))
            {
                echo $result['loginname'];
            }else{
                echo set_value('loginname');
            }
            ?>" required="">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-sm-2">
            <label for="group">Group: </label>

        </div>
        <div class="col-sm-2">
            <?php 
            if(isset($group))
            {
                echo $group;
            }else{
                echo set_value('group');
            } 
                    ?>
            <!--to be altered to selection box-->
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="email">E-mail: </label>

        </div>
        <div class="col-sm-2">
            <input type="email" class="form-control" name="email" value="<?php 
            if(isset($result))
            {
                echo $result['email'];
            }else{
                echo set_value('email');
            }
                    ?>" required="">
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
            <input type="hidden" name="orig_loginname" value="<?php 
            if(isset($result))
            {
                echo $result['loginname'];
            }else{
                echo set_value('loginname');
            }
            ?>">
        </div>
        <div class="col-sm-3"><button type="submit" class="btn btn-success">Update</button>
            <a href="/admin/admin_view" class="btn btn-default">Cancel</a></div>
    </div>

</form>
