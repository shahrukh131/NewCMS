@extends('layouts.app')

@section('content')

<div class="card card-default">
    <div class="card card-header">
        {{isset($post)?'Edit Post':'Create Post'}}
    </div>
    <div class="card card-body">
    <form action="{{isset($post)? route('posts.update',$post->id ):route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        @if(isset($post))
            @method('PUT')

        @endif


        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{isset($post)? $post->Title : ''}}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{isset($post)? $post->description : ''}}</textarea>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            {{-- <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea> --}}
            <input id="content" type="hidden" name="content" value="{{isset($post)? $post->content : ''}}">
            <trix-editor input="content"></trix-editor>
        </div>

         <div class="form-group">
            <label for="published_at">Published_at</label>
            <input type="text" class="form-control" name="published_at" id="published_at" value="{{isset($post)? $post->published_at : ''}}">
        </div>

        @if(isset($post))

        <div class="form-group">
           <img src="{{asset($post->image)}}" alt="{{$post->Title}}" width="440px" height="200px">
        </div>

        @endif


        <div class="form-group">
            <label for="imaget">Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <div class="form-group">
            <label for="catagory">Catagory</label>
            <select name="catagory" id="catagory" class="form-control ">
               @foreach ($catagories as $catagory)
                <option value="{{$catagory->id}}"
                   @if (isset($post))
                        @if ($catagory->id == $post->catagory_id)
                            selected
                        @endif

                   @endif
                    >
                    {{$catagory->name}}
                </option>

               @endforeach
            </select>
        </div>

       @if ($tags->count()>0)
        <div class="form-group">
            <label for="tags">tags</label>
            <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                @foreach ($tags as $tag)
                    <option value="{{$tag->id}}"

                      @if (isset($post))

                        @if ($post->hasTag($tag->id))

                            selected

                        @endif

                      @endif


                        >
                        {{ $tag->name }}
                    </option>

                @endforeach

            </select>
        </div>

       @endif




        <div class="form-group">
            <button class="btn btn-success">
               {{isset($post)? 'Update Post' : 'Create Post'}}
            </button>
        </div>
    </form>
    </div>
</div>

@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>

    flatpickr('#published_at',{
        enableTime:true
    })

    $(document).ready(function() {
        $('.tags-selector').select2();
    });


</script>

@endsection

@section('css')


<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


@endsection