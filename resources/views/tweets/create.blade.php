<div class="panel panel-default">
    <div class="panel-heading">Post a new tweet</div>
    <div class="panel-body">
        <form action="/tweets" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
                <textarea class="form-control" name="tweet" rows="3"></textarea>
            </div>
            <div class="text-right">
                <button class="btn btn-primary">Tweet</button>
            </div>
        </form>
    </div>
</div>