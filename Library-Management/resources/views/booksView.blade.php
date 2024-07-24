
@extends('master')
@section('content')
<style>
    .addBookBtn{
        width: auto;
    }
    .addBookBtnRow{
        justify-content: end;
        display: flex;
    }
</style>
    <div class="container px-0">
        <div class="row pt-3 addBookBtnRow">
            <a  href="{{route('addBookView')}}" class="btn btn-primary addBookBtn">Add Book</a>
        </div>
        <div class="row px-0 pt-5">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
@endsection