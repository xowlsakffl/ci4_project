<h1><?=esc($title);?></h1>
<main>
    <?=session()->getFlashdata('error')?>
    <?=service('validation')->listErrors()?>
    <form action="/news/create" method="post">
        <?=csrf_field()?>
        <div>
            <label for="title">Title</label>
            <input type="text" name="title">
        </div>
        <div>
            <label for="body">Body</label>
            <textarea rows="" cols="" name="body"></textarea>
        </div>
        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug">
        </div>
        <input type="submit" value="Create News">
    </form>
</main>