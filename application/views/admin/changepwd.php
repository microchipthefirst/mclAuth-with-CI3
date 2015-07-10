<?php if(isset($message)){
    echo "<h3>$message</h3>";
}
echo validation_errors();
?>
<form name="login" method="post" action="/admin/changepwd/reset">
    <div class="row form-group">
    <div class="col-sm-2">
        <label for="loginname">Login name</label>
    </div>
    <div class="col-sm-2">
        <input type="text" name="loginname" id="loginname" value="<?php echo set_value('loginname') ?>" class="form-control" required>
    </div>
</div>
    <div class="row form-group">
    <div class="col-sm-2">
        <label for="opwd">Old password</label>
    </div>
    <div class="col-sm-2">
        <input type="password" name="opwd" id="opwd" class="form-control" required>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-2">
        <label for="npwd">New password</label>
    </div>
    <div class="col-sm-2">
        <input type="password" name="npwd" id="npwd" class="form-control" required>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-2">
        <label for="rpwd">Repeat password</label>
    </div>
    <div class="col-sm-2">
        <input type="password" name="rpwd" id="npwd" class="form-control" required>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-2">
        
    </div>
    <div class="col-sm-3">
        <button type="submit" class="btn btn-lg">Submit</button>&nbsp;<a href="/admin/login" class="btn btn-default">Cancel</a></div>
    </div>
</div>
</form>