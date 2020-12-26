@extends('rancor::layouts.main')

@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card mb-4">
            <div class="card-header">
               {{ __('New Article') }}
            </div>
            <div class="card-body">
               <form action="/news/articles" method="POST">
                  @csrf
                  <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp" placeholder="Enter a new title" autofocus required value="{{ old('title') }}">
                     @error('title')
                     <small id="titleHelp" class="form-text text-danger">{{ $message }}</small>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="body">Body</label>
                     <textarea class="form-control @error('body')border border-danger @enderror" name="body" id="body" aria-describedby="bodyHelp" required rows="10" value="{{ old('body') }}"></textarea>
                     @error('body')
                     <small id="bodyHelp" class="form-text text-danger">{{ $message }}</small>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="tags">Tags</label>
                     <select class="form-control @error('tags')border border-danger @enderror" name="tags[]" id="tags" aria-describedby="tagsHelp" multiple value="{{ old('tags') }}">
                        @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name}}</option>
                        @endforeach
                     </select>
                     @error('tags')
                     <small id="tagsHelp" class="form-text text-danger">{{ $message }}</small>
                     @enderror
                  </div>
                  <div class="form-check">
                     <input type="checkbox" class="form-check-input" name="is_published" id="publish" aria-describedby="publishHelp">
                     <label for="title" class="form-check-label">Publish?</label>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection