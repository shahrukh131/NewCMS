@extends('layouts.app')


@section('content')





<div class="card card-default">
    <div class="card-header">
        {{isset($catagory)?'Edit Catagory' : 'Create catagory'}}
    </div>
    <div class="card-body">
        @if ($errors->any())

        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach ($errors->all() as $error)
                    <li class="list-group-item text-danger">
                        {{$error}}
                    </li>
                @endforeach
            </ul>

        </div>
        @endif

        <form action="{{ isset($catagory) ? route('catagories.update',$catagory->id):route('catagories.store') }}" method = "POST">
        @csrf

      

        @if(isset($catagory))
          @method('PUT')
            


        @endif

       
            <div class="form-group">
                <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{isset($catagory)? $catagory->name : ''}}">

            </div>

            <div class="form-group">
                <button class="btn btn-success"> 
                    {{isset($catagory) ? 'Update Catagory' :'Create Catagory'}}

                </button>
            </div>
        </form>
    </div>

</div>


@endsection
