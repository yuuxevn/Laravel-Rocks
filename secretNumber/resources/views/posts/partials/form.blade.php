<div class="form-group">
    <input type="file" class="form-control" name="thumbnail" id="thumbnail">
    @error('thumbnail')
    <div class="text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ??  $post->title }}">
    @error('title')
    <div class="text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category">
        <option disabled selected>choose One</option>
        @foreach($categories as $category)
        <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category')
    <div class="text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <select class="form-control" id="tags" name="tags[]" multiple>
        @foreach($post->tags as $tag)
        <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    @error('tags')
    <div class="text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" id="body" name="body">{{ old('body') ?? $post->body }}</textarea>
    @error('body')
    <div class="text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
<button class="btn btn-primary" type="submit">{{ $submit ?? 'Updated' }}</button>