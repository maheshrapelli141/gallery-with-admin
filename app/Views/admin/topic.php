<div class="container">
    <br>
    <h3><?= ucwords(service('uri')->getSegment(2)) ?></h3>
    <div class="card">
        <div class="card-body">
            <form action="/admin/topic" method="post" id="saveTopicForm" enctype="multipart/form-data">
              <?= csrf_field() ?> 
                <div class="row ">
                    <div class="col-3"></div>
                    <div class="col-6">

                      <?php if (session()->get('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                      <?php endif; ?>

                        <input type="hidden" name="topic_id">
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" class="form-control" name="name" placeholder="Enter Topic">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" class="form-control" placeholder="Enter topic description"></textarea>
                        </div>
                        <div class="form-group">
                          <label>Images</label>
                          <input type="file" class="form-control" name="images[]" multiple>
                        </div>
                        <div class="form-group">
                          <label>Categories</label>
                          <select class="form-control" name="categories[]" multiple>
                            <option value="" disabled selected>Select one category</option>
                            <?php foreach($categories as $category) { ?>
                              <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php }?>
                          </select>
                        </div>
                        <?php if (isset($validation)): ?>
                          <div class="alert alert-danger" role="alert">
                              <?= $validation->listErrors() ?>
                          </div>
                        <?php endif; ?>
                          <br>
                        <button type="submit" class="btn btn-info btn-right">Save</button>
                    </div>
                    <!-- <div class="col-3"></div> -->
                    
                </div>
            </form>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <th>Id</th>
            <th>Topic</th>
            <th>Actions</th>
        </thead>
        <?php if(count($topics)) { ?>
        <?php for($i=0;$i < count($topics);$i++) { ?>
        <tr>
            <td><?= $topics[$i]['id'] ?></td>
            <td><?= $topics[$i]['name'] ?></td>
            <td style="display:flex;">
              <form action="/admin/topic/delete">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $topics[$i]['id'] ?>">
                <button type="submit" class="btn btn-danger" onclick='if (confirm("Confirm Delete topic, this might loss all topics ?")) return true; else return false;'>
                  <i class="fa fa-trash"></i>
                </button>
              </form> &nbsp;
              <button type="button" class="btn btn-primary btn-edit" data-id="<?= $topics[$i]['id'] ?>" data-value="<?= $topics[$i]['name'] ?>">
                  <i class="fa fa-edit"></i>
                </button>
            </td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
            <td colspan='3'>No Topics Added yet</td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
(async () => {
  $saveTopicForm = $('#saveTopicForm');

  $('.btn-edit').click((e) => {
    const topicId = e.currentTarget.dataset.id;
    const topicName = e.currentTarget.dataset.value;
    console.log({topicId,topicName})
    $saveTopicForm.find('input[name=topic_id]').val(topicId);
    $saveTopicForm.find('input[name=topic]').val(topicName);
  })
})();
</script>