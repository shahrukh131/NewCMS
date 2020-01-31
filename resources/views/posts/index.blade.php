@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
<a href="{{route('posts.create')}}" class="btn btn-success">Add Post</a>

</div>
<div class="card card-default">
    <div class="card card-header">
        Posts
    </div>

    <div class="card card-body">
       @if($posts->count()>0)
        <table class="table">
            <thead>
                <th>image</th>
                <th>title</th>
                <th>Catagory</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>
                    <img src="{{($post->image)}}" alt="{{$post->Title}}" width="220px" height="120px">
                    </td>
                    <td>
                        {{$post->Title}}

                    </td>

                    <td>
                        <a href="">{{$post->catagory->name}}</a>
                    </td>

                    @if ($post->trashed())

                    <td>
                        <form action="{{route('restore-posts',$post->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type = 'submit'class="btn btn-info btn-sm">Restore</button>
                        </form>

                    </td>
                    @else
                     <td>
                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a>

                    </td>



                    @endif
                    <td>
                    <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                         <button class="btn btn-danger btn-sm">
                             {{$post->trashed()?'Delete':'Trash'}}
                         </button>
                    </form>
                    </td>


                </tr>

                @endforeach

            </tbody>


        </table>

       @else

       <h3 class="text-center">No posts available</h3>


       @endif

    </div>

</div>

@endsection
