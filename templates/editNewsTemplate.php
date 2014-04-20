<div class="row">
    <h1>Edit News</h1>
    <form class="" action="[@url]" method="POST">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="[@name]">
        </div>
        <div class="row form-group">
            <label >Content</label>
            <textarea  name="content" rows="10" class="form-control">
            [@content]
            </textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>