<?php

echo "<p>Delete $type with name: ".$loginname; 
 ?>
<form name="deleteuser" method="post" action="<?php echo $action ?>">
    <!--$action is generated in admin_view/delete_user-->
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-danger">Confirm delete</button>
    <a href="/admin/admin_view" class="btn btn-default">Cancel</a>
</form>
</p> 