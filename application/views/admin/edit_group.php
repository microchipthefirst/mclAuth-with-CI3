<h1>Edit a group</h1>
<?php
echo validation_errors();
?>
<form name="edituser" method="post" action="/admin/group/edit_group">
    <div class="row form-group" >
        <div class="col-sm-2">
            <label for="name">Name: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="name" value="<?php 
            if(isset($result))
            {
                echo $result['name'];
            }else{
                echo set_value('name');
            }
            
                ?>" required>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-2">
            <label for="desc">Description: </label>

        </div>
        <div class="col-sm-2">
            <input type="text" class="form-control" name="desc" value="<?php if(isset($result))
            {
                echo $result['desc'];
            }else{
                echo set_value('desc');
            }
            ?>" required="">
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-2">
            <input type="hidden" name="id" value="<?php
            if(isset($result)){
                echo $result['id'];
            }else{
                echo set_value('id');
            }
            ?>">
            <input type="hidden" name="orig_name" value="<?php 
            if(isset($result))
            {
                echo $result['name'];
            }else{
                echo set_value('name');
            }
            ?>">
        </div>
        <div class="col-sm-3"><button type="submit" class="btn btn-success">Update</button>
        <a href="/admin/admin_view" class="btn btn-default">Cancel</a>
        </div>
    </div>

</form>
