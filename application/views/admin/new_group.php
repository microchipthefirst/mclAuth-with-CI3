<h1>Create a new group</h1>
<?php
echo validation_errors();
?>
<form name="creategroup" method="post" action="/admin/group/new_group">
    <div class="row form-group" >
        <div class="col-sm-2">
            <label for="name">Name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="name" value="<?php echo set_value('name') ?>" required>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="desc">Description: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="desc" value="<?php echo set_value('desc') ?>" required="">
        </div>
    </div>

    <div class="row form-group">
        <div class="col-sm-2">
            

        </div>
        <div class="col-sm-5">
            You will need to activate this group before using it.
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-2"><button type="submit" class="btn btn-success">Create</button>
            <a href="/admin/admin_view" class="btn btn-default">Cancel</a>
        </div>
    </div>

</form>
