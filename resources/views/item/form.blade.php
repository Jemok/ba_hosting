<form id="addFrm" role="form">

    <div class="form-group">
        <input type="hidden" name="innovation_id" value="{{$id}}">
        <input type="text" class="form-control" name="title"  id="title" required="required" placeholder="type your message">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-sm btn-block btn-primary" name="submit" value="Send">
    </div>
</form>