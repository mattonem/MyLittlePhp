<div class="">
    <div class="row">
    <h1 class="">Admin login</h1>
    </div>
    <div class="row">
    <form class=" form-inline" action="[@url]" method="POST">
        <div class="text-danger">
            [@msg]
        </div>
        <div class="form-group">
            <label class="sr-only">Name</label>
            <input type="text" name="username" class="form-control" placeholder="Username">
        </div>
        <div class="form-group">
            <span class="sr-only">Password</span>
            <input type="password" name="password" class="form-control" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    </div>
    <a href="./?action=loggout">
        <small class="text-muted">loggout</small>
    </a>
</div>