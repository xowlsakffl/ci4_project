<?=$this->extend('layouts/frontend.php');?>
<?=$this->section('script');?>
<script>
function onFileUpload(input) {
    id = '#preview';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(id).attr('src', e.target.result).width(300)
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?=$this->endSection();?>
<?=$this->section('content');?>
    <!--modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postForm" method="post">
                    
                    <div class="d-grid text-center">
                        <img class="mb-3" id="preview" alt="Preview Image" src="/img/previewImage.png" />
                    </div>

                    <div class="mb-3">
                        <input type="file" name="file" id="fileInput" multiple="true" class="form-control form-control-lg" onChange="onFileUpload(this)">
                        <span id="error_file" class="text-danger ms-3"></span>
                    </div>

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control title">
                        <span id="error_title" class="text-danger ms-3"></span>
                    </div>

                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control body" id="" cols="30" rows="10"></textarea>
                        <span id="error_body" class="text-danger ms-3"></span>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" class="form-control slug">
                        <span id="error_slug" class="text-danger ms-3"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-dark ajaxpost-save">Add Post</button>
            </div>
            </div>
        </div>
    </div>
    <!--content-->
    <div class="container-md">
        <div class="row">
            <div class="col">
                <form action="/posts" id="frm" method="get" class="d-flex mb-3">
                    <input type="text" name="searchData" class="form-control mx-3" id="searchText">
                    <input type="submit" value="Search" class="btn btn-primary">                  
                </form>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) : ?>
                        <tr onclick="location.href='/posts/<?=$post['id']?>'" role="button">
                            <td><?= esc($post['id']) ?></td>
                            <td><img src="<?=base_url('/uploads/'.$post['img_name'])?>" alt="" style="max-width:100px"></td>
                            <td><?= esc(mb_strimwidth($post['title'],0,15,"..","UTF-8")) ?></td>
                            <td><?= esc(mb_strimwidth($post['body'],0,15,"..","UTF-8")) ?></td>
                            <td><?= esc($post['slug']) ?></td>
                            <td><?= esc($post['created_at']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="row">
                <?= $pager->links() ?>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-end">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Post
                </button>
            </div>
        </div>
    </div>
<?=$this->endSection();?>

<?=$this->section('script');?>
<script>
    $(document).ready(function () {
        let csrfToken = '<?=csrf_token()?>';
        let csrfHash = '<?=csrf_hash()?>';
        error_file = '';
        error_title = '';
        error_body = '';
        error_slug = '';

        $('.ajaxpost-save').click(function (e) {      
            if ($('#fileInput').val() == '') {
                error_file = 'Please choice file.';
                $('#error_file').text(error_file);
                $('#fileInput').focus();
            }else if($.trim($('.title').val()).length == 0) {
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
            
            
            if(error_file != '' || error_title != '' || error_body != '' || error_slug != ''){
                return false;
            }else{
                var data = new FormData(document.getElementById('postForm'));
                data.append([csrfToken], csrfHash);

                $.ajax({
                    type: "post",
                    url: "<?=base_url('posts')?>",
                    data: data,
                    dataType: "json",
                    contentType: false,//default 값은 "application/x-www-form-urlencoded; charset=UTF-8", "multipart/form-data"로 전송되도록 false 설정. 명시적으로 "multipart/form-data"으로 설정해주면 boundary string이 안 들어가 제대로 동작하지 않는다.
                    processData: false,//processData : 일반적으로 서버에 전달되는 데이터는 query string 형태이다.
                    success: function (response) {
                        $('#exampleModal').modal('hide');
                        $('#exampleModal').find('input').val('');   
                        console.log(response.status);
                        if(response.status == true){
                            alertify.set('notifier', 'position', 'top-right');
                            alertify.success(response.message);
                        }else{
                            alert(response.message);
                        }      
                    }
                });
            }
            
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