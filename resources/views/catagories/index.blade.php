@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{route('catagories.create')}}" class="btn btn-success">Add Catagory</a>

</div>



<div class="card card-default">
     <div class="card card-header">
         Catagories

     </div>

     <div class="card card-body">
        @if($catagories->count()>0)
         <table class="table">
             <th>Name</th>
             <th>Post Count</th>
             <th></th>

             <tbody>
                 @foreach ($catagories as $catagory)
                 <tr>
                     <td>
                         {{$catagory->name}}
                     </td>

                     <td>
                       {{$catagory->posts->count()}}
                     </td>

                     <td>
                     <a href="{{ route('catagories.edit',$catagory->id) }}" class="btn btn-primary btn-sm">Edit</a>
                     <button class='btn btn-danger btn-sm' onclick="handleDelete({{$catagory->id}})">Delete</button>
                     </td>
                 </tr>

                     
                 @endforeach
             </tbody>

         </table>
          @else

       <h3 class="text-center">No Catagories available</h3>


       @endif



<!-- Modal -->
         <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <form action="" method="POST" id="deleteCatagoryForm">
        @csrf
        @method('DELETE')
       
        <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Catagory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center text-bold"><strong>Are you sure you want to Delete?</strong> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
        <button type="submit" class="btn btn-danger">Yes,Delete</button>
      </div>
    </div>
    </form>
  </div>
</div>
     </div>

</div>


@endsection

@section('scripts')

<script>
    function handleDelete(id){
        
        var form = document.getElementById('deleteCatagoryForm');
        form.action = '/catagories/'+ id;
        console.log('deleting..',form);
        $('#deleteModal').modal('show');

    }

</script>
    
@endsection