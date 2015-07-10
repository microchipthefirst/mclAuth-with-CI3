<?php if(isset($message)){
    echo "<h3>$message</h3>";
} ?>
<form name="login" method="post" action="/admin/login/loginuser">
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="loginname">Login name</label>
        </div>
        <div class="col-sm-2">
            <input type="text" name="loginname" class="form-control" value="<?php echo set_value('loginname') ?>" required>
        </div>
    </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <label for="pwd">Password</label>
            </div>
            <div class="col-sm-2">
                <input type="password" name="pwd" class="form-control" required>
            </div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-lg">Login</button>&nbsp; <a href="<?php echo base_url('admin/changepwd') ?>">Forgotten password</a>
        </div>
    </div>
</form>

