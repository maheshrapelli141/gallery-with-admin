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
                        <input type="hidden" name="topic_id">
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" class="form-control" name="name" placeholder="Enter Topic" autofocus>
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" class="form-control" placeholder="Enter topic description"></textarea>
                        </div>
                        <div class="form-group">
                          <label>Images (jpg,png,jpeg files allowed)</label>
                          <span id="file-error"></span>
                          <input type="file" class="form-control" name="images[]" multiple id="uploadeImages" accept="image/*">
                          <input type="hidden" name="imageUrls">
                        </div>
                        <div class="card">
                          <div class="card-body">
                            <label>Current Selected Images</label>
                            <div id="uploadImagesSection"></div>
                          </div>
                          <div id="watermark-status" style="display:none">
                            <label>Applying Watermark on Images: <small>(image watermarking might take high cpu usage for large images, try to add upload upto max 10 images at once)</small></label>
                            <div class="progress">
                              <div class="progress-bar progress-bar-striped progress-bar-animated" id="watermark-progress-bar" style="width:0%;height:20px;"></div>
                            </div>
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
                        <div id="respMessage"></div>
                          <br>
                        <button type="submit" class="btn btn-info btn-right" id="btn-save">Save</button>
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
const uploadImagesBlobs = [];

const $saveTopicForm = $('#saveTopicForm');

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
  

  $saveTopicForm.validate({
    rules: {
      name: {
        required: true,
        minlength: 1,
        maxlength: 200
      },
      description: {
        required: true,
        minlength: 1,
        maxlength: 1500
      },
      'categories[]': 'required',
      'images[]': {
        required: true,
        extension: "jpg|png|jpeg"
      }
    },
    submitHandler: function(){
      const form = $saveTopicForm[0];
      const formData = new FormData(form);
      
      formData.delete('images[]');
      uploadImagesBlobs.map(file => formData.append('images[]',file));
      
      $('#btn-save').text('Uploading...').attr('disabled',true);
      

      $.ajax({
        method: 'post',
        url: '/admin/topic',
        dataType:'json',
        contentType: false,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
        },
        data: formData,
        processData: false
      })
      .then(resp => {
        console.log({resp});
        $saveTopicForm.trigger('reset');
        $('#btn-save').text('Save').attr('disabled',false);
        $('#uploadedImagesSection').empty();
        $('#uploadImagesSection').empty();
        // setTimeout(() => window.location.reload(),1500);
        $('#respMessage').empty().append(`<div class="alert alert-info">`+ resp.message + `</div>`);
        window.location.reload();
        // $saveTopicForm.find('input[name=name]').focus();
      })
      .catch(error => {
        console.log({error});
        if(error.responseJSON && error.responseJSON.errors){
          $('#respMessage').empty().append(`<div class="alert alert-danger">`+ error.responseJSON.errors + ` <br>If error not changes, try to refresh page and try again or check input files</div>`);
        }
        $('#btn-save').text('Save').attr('disabled',false);
      })
    }
  })

})();

(() => {
  $('body').on('click','.btn-edit',e => {
    const topicId = $(e.currentTarget).attr('data-id');
    const selectedTopic = topics.find(topic => topic.id === topicId);
    console.log({selectedTopic});
    $saveTopicForm.find('input[name=topic_id]').val(topicId);
    $saveTopicForm.find('input[name=name]').val(selectedTopic.name);
    $saveTopicForm.find('textarea[name=description]').val(selectedTopic.description);

    const selectedCategoryIds = selectedTopic.categories.map(selectedCategory => {
      return categories.find(category => category.id === selectedCategory.id.trim()).id;
    });
    $.each(categories, function(i,e){
      $("#categories option[value='" + e.id + "']").prop("selected", false);
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
    for(topic of  topics){
      topicTemplate += `<tr>
          <td>${topic['id']}</td>
          <td>${topic['name']}</td>
          <td>${topic['categories'].filter(category => category).map(category => category.name).join(',')}</td>
          <td style="display:flex;">
            <form action="/admin/topic/delete">
              <?= csrf_field() ?>
              <input type="hidden" name="id" value="${topic['id']}">
              <button type="submit" class="btn btn-danger" onclick='if (confirm("Confirm Delete topic, this might loss all topics ?")) return true; else return false;'>
                <i class="fa fa-trash"></i>
              </button>
            </form> &nbsp;
            <button type="button" class="btn btn-primary btn-edit" data-id="${topic['id']}" data-value="${topic['name']}">
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
    const files = Object.values(e.target.files);
    
    if(validateFileSize(files)){
      uploadImagesBlobs.splice(0,uploadImagesBlobs.length-1);
      $('#watermark-status').show();
      $('#uploadImagesSection').empty();

      for(let i=0;i< files.length;i++){
        const file = files[i];
        const percent = Math.round(((i+1)/files.length)*100);
        $('#watermark-progress-bar').css('width',percent+'%').text('('+percent+' %)');
        uploadImagesBlobs.push(file);
        const watermarkInst = watermark([file]);
        const watermarkProps = watermark.text.center('jeetprops.com','28px serif', '#fff', 0.5);
        const watermarkedDataUrl = await watermarkInst.dataUrl(watermarkProps);
        $('#uploadImagesSection').append(`
          <img src="${watermarkedDataUrl}" class="img-thumbnail" style="max-height:100px;max-width:100px;">
        `);
      }
      setTimeout(() =>$('#watermark-status').hide(),1000);
      
    }
  });

  function validateFileSize(files){
    console.log({files});
    let areAllOk = true;
    $('#file-error').empty();
    files.map(file => {
      if(file.size > 10000000){
        $('#file-error').append(`<p class="error">File size too large: ${file.name}</p>`);
        areAllOk = false;
      }
    });
    return areAllOk;
  }

  function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), 
        n = bstr.length, 
        u8arr = new Uint8Array(n);
        
    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    
    return new File([u8arr], filename, {type:mime});
  }
})();

// (() => {
//   $('#uploadeImages').on('change',async e => {
//     const files = e.target.files;
//     const base64Promises = Object.values(files).map(toBase64);
//     // $('#uploadImagesSection').empty();
//     (await Promise.all(base64Promises)).map(base64 => {
//       $('#uploadImagesSection').append(`
//         <img src="${base64}" class="img-thumbnail" style="max-height:100px;max-width:100px;">
//       `);
//     })
//   });
//   function toBase64(file) {
//     return new Promise((res,rej) => {
//       const reader = new FileReader();

//       reader.addEventListener("load", function () {
//         // convert image file to base64 string
//         return res(reader.result);
//       }, false);

//       if (file) {
//         reader.readAsDataURL(file);
//       }
//     });
//   }
// })();
</script>