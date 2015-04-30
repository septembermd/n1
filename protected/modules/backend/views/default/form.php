<form class="form-horizontal" id="user-form" action="/backend/user/create" method="post">
    <p class="help-block">Fields with <span class="required">*</span> are required.</p>


    <div class="control-group "><label class="control-label required" for="User_username">Username <span class="required">*</span></label><div class="controls"><input class="span5" maxlength="30" autocomplete="off" name="User[username]" id="User_username" type="text"></div></div>
    <div class="control-group "><label class="control-label required" for="User_password">Password <span class="required">*</span></label><div class="controls"><input class="span5" maxlength="50" autocomplete="off" name="User[password]" id="User_password" type="password"></div></div>
    <div class="control-group "><label class="control-label required" for="User_password_repeat">Password Repeat <span class="required">*</span></label><div class="controls"><input class="span5" maxlength="50" autocomplete="off" name="User[password_repeat]" id="User_password_repeat" type="password"></div></div>
    <div class="control-group "><label class="control-label" for="User_birthday">Birthday</label><div class="controls"><input class="span5 datepicker" name="User[birthday]" id="User_birthday" type="text"></div></div>
    <div class="control-group "><label class="control-label" for="User_email">Email</label><div class="controls"><input class="span5" maxlength="255" name="User[email]" id="User_email" type="text"></div></div>
    <div class="control-group "><label class="control-label required" for="User_role">Role <span class="required">*</span></label><div class="controls"><select class="span5" name="User[role]" id="User_role">
        <option value="">Select ...</option>
        <option value="1">Admin</option>
        <option value="2">User</option>
    </select></div></div>
    <div class="form-actions">
        <button class="btn btn-primary" type="submit" name="yt0">Create</button>	</div>

</form>