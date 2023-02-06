<?=$this->extend('layouts/frontend.php');?>

<?=$this->section('content');?>
    <!--modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frm" method="post">
                    <input type="hidden" name="_method" value="PUT" />
                    <div class="form-group">
                        <label for="title">Image</label>
                        <input type="file" name="Image" class="form-control image">
                        <span id="error_file" class="text-danger ms-3"></span>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control title" value="<?=esc($post['title'])?>">
                        <span id="error_title" class="text-danger ms-3"></span>
                    </div>

                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control body" id="" cols="30" rows="10"><?=esc($post['body'])?></textarea>
                        <span id="error_body" class="text-danger ms-3"></span>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" class="form-control slug" value="<?=esc($post['slug'])?>">
                        <span id="error_slug" class="text-danger ms-3"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark ajaxpost-save">Edit Post</button>
            </div>
            </div>
        </div>
    </div>

    <!--content-->
    <div class="container-md">
        <div class="row">
            <div class="col-5 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2"><?= esc(mb_strimwidth($post['title'],0,15,"..","UTF-8")) ?></h5>
                        <h5 class="card-title mb-2"><img src="<?=base_url('/uploads/'.$post['img_name'])?>" alt="" style="max-width:100px"></h5>
                        <h6 class="card-subtitle mb-2">
                            <?= esc($post['slug']) ?>
                        </h6>
                        <p class="card-text mb-5">
                            <?= esc(mb_strimwidth($post['body'],0,15,"..","UTF-8")) ?>
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-end mb-4">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Update
                            </button>
                            <button type="button" class="btn btn-danger deletePost">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?=$this->endSection();?>

<?=$this->section('script');?>
<script>
    $(document).ready(function () {
        let csrfToken = '<?=csrf_token()?>';
        let csrfHash = '<?=csrf_hash()?>';
        error_title = '';
        error_body = '';
        error_slug = '';

        $('.ajaxpost-save').click(function () { 
            if($.trim($('.title').val()).length == 0) {
                error_title = 'Please enter title.';
                $('#error_title').text(error_title);
                $('.title').focus();
            }else if($.trim($('.body').val()).length == 0){
                error_body = 'Please enter body.';
                $('#error_body').text(error_body);
                $('.body').focus();
            }else if($.trim($('.slug').val()).length == 0){
                error_slug = 'Please enter slug.';
                $('#error_slug').text(error_slug);
                $('.slug').focus();
            }

            if(error_title != '' || error_body != '' || error_slug != ''){
                return false;
            }else{
                data = {
                    [csrfToken]: csrfHash,
                    title: $('.title').val(),
                    body: $('.body').val(),
                    slug: $('.slug').val(),
                };

                $.ajax({
                    type: "put",
                    url: "<?=base_url('posts')."/".$post['id']?>",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        $('#exampleModal').modal('hide');
                        $('#exampleModal').find('input').val('');   
                        if(response.code == 200){
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(response.message);
                        }else{
                            alert(response.message);
                        }     
                           
                    }
                });
            }
            
        });


        $('.deletePost').click(function () { 
            $.ajax({
                type: "delete",
                url: "<?=base_url('posts')."/".$post['id']?>",
                data: '',
                dataType: "json",
                success: function (response) {
                    $('#exampleModal').modal('hide');
                    $('#exampleModal').find('input').val('');   
                    if(response.code == 200){
                        location.href='<?=base_url('posts')?>';
                    }else{
                        alert(response.message);
                    }      
                }
            });
        });

        $('.title').keypress(function () { 
            if($.trim($('.title').val()).length > 0){
                $('#error_title').text("");
            }
        });

        $('.body').keypress(function () { 
            if($.trim($('.body').val()).length > 0){
                $('#error_body').text("");
            }
        });

        $('.slug').keypress(function () { 
            if($.trim($('.slug').val()).length > 0){
                $('#error_slug').text("");
            }
        });
    });
</script>
<?=$this->endSection();?>