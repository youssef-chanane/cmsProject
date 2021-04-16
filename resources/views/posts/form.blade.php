<x-error></x-error>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{old('title',isset($post->title) ? $post->title:'') ?? NULL}}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" cols="5" rows="5" class="form-control" >{{old('description',isset($post->description) ? $post->description:'') ?? NULL}}</textarea>
</div>
<div class="form-group">
    <label for="content">content</label>
    <textarea name="content" id="content" cols="5" rows="5" class="form-control" >{{old('content',isset($post->content) ? $post->content:'') ?? NULL}}</textarea>
</div>
<div class="form-group">
    <label for="image">image</label>
    <input type="file" name="image" id="image" class="form-control" >
</div>
