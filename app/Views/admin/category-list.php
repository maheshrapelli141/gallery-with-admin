<div class="container">
    <br>
    <h3><?= ucwords(service('uri')->getSegment(2)) ?></h3>
    <div class="card">
        <div class="card-body">
            <form action="/admin/category" method="post" id="saveCategoryForm">
              <?= csrf_field() ?> 
                <div class="row ">
                    <div class="col-4"></div>
                    <div class="col-4">

                      <?php if (session()->get('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get('success') ?>
                        </div>
                      <?php endif; ?>

                        <input type="hidden" name="category_id">
                        <label>Category</label>
                        <input type="text" class="form-control" name="category" placeholder="Enter Category" autofocus>

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
            <th>Category</th>
            <th>Actions</th>
        </thead>
        <?php if(count($categories)) { ?>
        <?php for($i=0;$i < count($categories);$i++) { ?>
        <tr>
            <td><?= $categories[$i]['id'] ?></td>
            <td><?= $categories[$i]['name'] ?></td>
            <td style="display:flex;">
              <form action="/admin/category/delete">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= $categories[$i]['id'] ?>">
                <button type="submit" class="btn btn-danger" onclick='if (confirm("Confirm Delete Category, this might loss all topics ?")) return true; else return false;'>
                  <i class="fa fa-trash"></i>
                </button>
              </form> &nbsp;
              <button type="button" class="btn btn-primary btn-edit" data-id="<?= $categories[$i]['id'] ?>" data-value="<?= $categories[$i]['name'] ?>">
                  <i class="fa fa-edit"></i>
                </button>
            </td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
            <td colspan='3'>No Categories Added yet</td>
        </tr>
        <?php } ?>
    </table>
</div>

<script>
(async () => {
  $saveCategoryForm = $('#saveCategoryForm');

  $('.btn-edit').click((e) => {
    const categoryId = e.currentTarget.dataset.id;
    const categoryName = e.currentTarget.dataset.value;
    console.log({categoryId,categoryName})
    $saveCategoryForm.find('input[name=category_id]').val(categoryId);
    $saveCategoryForm.find('input[name=category]').val(categoryName);
  })
})();
</script>