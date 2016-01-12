<form method="post" action="{{ route('changePassword') }}" class="profile">
    <h3 class="section__title">Edit Password</h3>
    <fieldset name="personal" class="form__cluster">

        {{ CSRF_FIELD() }}

        <div class="form-group">
            <div class="form__field">
                <div class="form-group">
                    <div class="form__field">
                        <label class="sr-only">Old Password</label>
                        {!! $errors->first('old_password', '<label class="help-block">:message</label>' ) !!}
                        <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form__field">
                        <label class="sr-only">New Password</label>
                        {!! $errors->first('password', '<label class="help-block">:message</label>' ) !!}
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form__field">
                        <label class="sr-only">Confirm Password</label>
                        {!! $errors->first('password_confirmation', '<label class="help-block">:message</label>' ) !!}
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <footer class="form__footer">
        <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Change</button>
    </footer>
</form>