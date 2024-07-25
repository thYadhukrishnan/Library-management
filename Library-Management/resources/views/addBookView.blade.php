
@extends('master')
@section('content')
<div class="alert alert-success" role="alert" style="display: none;" id="successDiv">
</div>
<div class="alert alert-danger" role="alert" style="display: none;" id="errorDiv">
</div>
    <div class="container px-0">
        <div class="form-group row pt-3">
            <label class="col-sm-2">Book Name :</label>
            <div class="col-sm-4"> 
              <input  type="text" name="bookName" class="form-control" id="bookName" placeholder="" required>
            </div>
        </div>

        <div class="form-group row pt-3">
          <label class="col-sm-2">Book Category :</label>
          <div class="col-sm-4">
            <select class="form-select " name="category" id="category" required>
              <option value="" selected>--Category--</option>
              @foreach ($bookCategoryData as $category)
                <option value="{{$category->id}}">{{$category->book_category_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-sm-2">
            <a class="btn btn-secondary" id="addCategory" href ={{route('categoryList')}}>
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
              </svg>
            </a>
          </div>
        </div>

      <div class="form-group row pt-3">
        <label class="col-sm-2">Book Author :</label>
        <div class="col-sm-4">
          <select class="form-select " name="author" required>
            <option value="" selected>--Author--</option>
          </select>
        </div>
        <div class="col-sm-2">
          <a class="btn btn-secondary" id="addAuthor">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
          </a>
        </div>
      </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="addAuthorModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Author</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row pt-3">
                <label class="col-sm-2">Book Author :</label>
                <div class="col-sm-4"> 
                  <input  type="text" name="author" class="form-control" id="author" placeholder="" required>
                </div>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id ="addAuthorBtn">Save </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function(){
        $('#addCategoryBtn').click(function(){
          var categoryName = $('#bookCategory').val();
          $.ajax({
            url:'{{route('saveCategory')}}',
            method:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data:{
              categoryName:categoryName
            },
            success:function(response){
              if(response.status == 'true'){
                var len = response.bookCategoryData.length;
                var options = '';
                for(var i=0;i<len;i++){
                  var bookCategory = response.bookCategoryData[i];
                  var option = `<option value="${bookCategory.id}">${bookCategory.book_category_name}</option>`;
                  options += option;               
                }
                $('#category').append(options).trigger('change');
                $('#addCategoryModal').modal('hide');
                $('#successDiv').html('Category Added Successfully');
                $('#successDiv').show();
                setTimeout(() => {
                  $('#successDiv').html('');
                  $('#successDiv').hide();
                }, 3000);
              }else{
                $('#addCategoryModal').modal('hide');
                $('#errorDiv').html('Already have same category');
                $('#errorDiv').show();
                setTimeout(() => {
                  $('#errorDiv').html('');
                  $('#errorDiv').hide();
                }, 3000);
              }
            }
          });
        });
      });
    </script>

@endsection