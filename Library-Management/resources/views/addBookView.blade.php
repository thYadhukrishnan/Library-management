
@extends('master')
@section('content')
<div class="alert alert-success" role="alert" style="display: none;" id="successDiv">
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
            </select>
          </div>
          <div class="col-sm-2">
            <button class="btn btn-secondary" id="addCategory" data-toggle="modal" data-target="#addCategoryModal">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
              </svg>
            </button>
          </div>
        </div>

      <div class="form-group row pt-3">
        <label class="col-sm-2">Book Author :</label>
        <div class="col-sm-4">
          <select class="form-select " name="author" required>
            <option value="" selected>--Category--</option>
          </select>
        </div>
        <div class="col-sm-2">
          <button class="btn btn-secondary" id="addCategory">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="addCategoryModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group row pt-3">
                <label class="col-sm-2">Book Category :</label>
                <div class="col-sm-4"> 
                  <input  type="text" name="bookCategory" class="form-control" id="bookCategory" placeholder="" required>
                </div>
            </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id ="addCategoryBtn">Save </button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
              }
            }
          });
        });
      });
    </script>

@endsection