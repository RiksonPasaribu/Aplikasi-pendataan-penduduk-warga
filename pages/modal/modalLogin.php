<!-- Modal -->
<div class="modal fade" id="exampleModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control form-control-sm" placeholder="Username.." required />
                    </div>
                    <div class="form-group">
                        <label for="">Password..</label>
                        <input type="password" name="password" class="form-control form-control-sm" placeholder="Password..." required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="login" class="btn btn-primary btn-sm">Login</button>
                    <button type="reset" name="reset" class="btn btn-warning btn-sm" data-dismiss="modal">
                        <span class="iconify" data-icon="fluent:arrow-reset-20-regular" data-inline="false"></span>
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>