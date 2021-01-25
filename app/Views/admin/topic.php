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
                          <input type="file" class="form-control" name="images[]" multiple id="uploadeImages">
                          <input type="hidden" name="imageUrls">
                        </div>
                        <div class="card">
                          <div class="card-body">
                            <label>Current Selected Images</label>
                            <div id="uploadImagesSection"></div>
                          </div>
                        </div><br>
                        <div class="card">
                          <div class="card-body">
                            <label>Uploaded Images</label>
                            <div id="uploadedImagesSection" style="display: flex;"></div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Categories</label>
                          <select class="form-control" name="categories[]" multiple id="categories">
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
                        <?php if (isset($errors) && count($errors)): ?>
                          <div class="alert alert-danger" role="alert">
                            <? foreach($errors as $error){
                              echo $error;
                               } ?>
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

    <table class="table table-striped" id="topics-table">
        <thead>
            <th>Id</th>
            <th>Topic</th>
            <th>Categories</th>
            <th>Actions</th>
        </thead>
    </table>
</div>

<script>
const topics = <?= json_encode($topics) ?>;
const categories = <?= json_encode($categories) ?>;

$saveTopicForm = $('#saveTopicForm');

let selectedTopicImages = null;

function removeImageByIndex(index){
  
  selectedTopicImages = selectedTopicImages.toString().split(',')
  selectedTopicImages.splice(Number(index),1)
  if(selectedTopicImages.length)
    selectedTopicImages = selectedTopicImages.join(',');
  selectedTopicImages = null;
  renderUrlBasedImages();
}

function renderUrlBasedImages(){
  $saveTopicForm.find('input[name=imageUrls]').val(selectedTopicImages);
  $('#uploadedImagesSection').empty();
  selectedTopicImages.toString().split(',').map((imageUrl,i) =>{
      $('#uploadedImagesSection').append(`
      <div style="position:relative">
        <button type="button" class="btn btn-link btn-right btn-remove-image" style="position: absolute;top:0;right:0;" data-id="${i}">&times;</button>
        <img src="${imageUrl}" class="img-thumbnail" style="max-height:100px;max-width:100px;">
        </div>
      `)
    })
}

(() => {
  $('body').on('click','.btn-edit',e => {
    const topicId = $(e.currentTarget).attr('data-id');
    const selectedTopic = topics.find(topic => topic.id === topicId);
    console.log({selectedTopic});
    $saveTopicForm.find('input[name=topic_id]').val(topicId);
    $saveTopicForm.find('input[name=name]').val(selectedTopic.topic_name);
    $saveTopicForm.find('textarea[name=description]').val(selectedTopic.description);

    const selectedCategoryIds = selectedTopic.categories.split(',').map(selectedCategory => {
      return categories.find(category => category.name === selectedCategory.trim()).id;
    });
    $.each(selectedCategoryIds, function(i,e){
      $("#categories option[value='" + e + "']").prop("selected", true);
    });

    selectedTopicImages = selectedTopic.images;
    $('#uploadedImagesSection').empty();
    renderUrlBasedImages();
  });

  $('body').on('click','.btn-remove-image',e => {
    const imageIndex = $(e.currentTarget).attr('data-id');
    removeImageByIndex(imageIndex);
  });
})();

(() => {
  let topicTemplate = '';
  if(topics.length){ 
    const customTopicsData = {};
    topics.map(topic => {
      if(!customTopicsData[topic.id]){
        customTopicsData[topic.id] = topic;
        customTopicsData[topic.id]['categories'] = topic.category;
      }
      else if(!customTopicsData[topic.id]['categories'])
        customTopicsData[topic.id]['categories'] = customTopicsData[topic.id]['category'] + ', '+topic.category;
      else
        customTopicsData[topic.id]['categories'] = customTopicsData[topic.id]['categories']+ ', '+topic.category;
    })
    for(topicId in  customTopicsData){
      topicTemplate += `<tr>
          <td>${customTopicsData[topicId]['id']}</td>
          <td>${customTopicsData[topicId]['topic_name']}</td>
          <td>${customTopicsData[topicId]['categories']}</td>
          <td style="display:flex;">
            <form action="/admin/topic/delete">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="${customTopicsData[topicId]['id']}">
              <button type="submit" class="btn btn-danger" onclick='if (confirm("Confirm Delete topic, this might loss all topics ?")) return true; else return false;'>
                <i class="fa fa-trash"></i>
              </button>
            </form> &nbsp;
            <button type="button" class="btn btn-primary btn-edit" data-id="${customTopicsData[topicId]['id']}" data-value="${customTopicsData[topicId]['topic_name']}">
                <i class="fa fa-edit"></i>
              </button>
          </td>
      </tr>`
    }
  }
  else topicTemplate = `<tr><td colspan="4">No Topics added yet</td></tr>`

  $('#topics-table').append(topicTemplate);
})();

(() => {
  $('#uploadeImages').on('change',async e => {
    const files = e.target.files;
    const base64Promises = Object.values(files).map(toBase64);
    // $('#uploadImagesSection').empty();
    (await Promise.all(base64Promises)).map(base64 => {
      $('#uploadImagesSection').append(`
        <img src="${base64}" class="img-thumbnail" style="max-height:100px;max-width:100px;">
      `);
    })
  });
  function toBase64(file) {
    return new Promise((res,rej) => {
      const reader = new FileReader();

      reader.addEventListener("load", function () {
        // convert image file to base64 string
        return res(reader.result);
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    });
  }
})();
</script>