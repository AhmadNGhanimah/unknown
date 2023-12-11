<form class="ajax-modal-form" action="{{ isset($item) ? route('audio.update', $item->id) : route('users.store') }}"
      id="audio-form" enctype="multipart/form-data" method="post">
    @csrf
    @if(isset($item))
        @method('PUT')
        <input type="hidden" name="id" value="{{$item->id}}">
    @endif

    {{--    <div class="form-group">--}}
    {{--        <label for="status" class="form-label">Categories</label>--}}
    {{--        <select class="form-select" id="status" name="category_id" required="required" {{ isset($showOnly) && $showOnly == 1 ? 'disabled' : '' }}>--}}
    {{--            <option selected="" disabled="" value="">Choose</option>--}}
    {{--            @foreach($categories as $category)--}}
    {{--                <option {{ isset($item) && $item->category_id == $category->id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}} - {{$category->name_ar}}</option>--}}
    {{--            @endforeach--}}
    {{--        </select>--}}
    {{--    </div>--}}

    <div class="form-group">
        <label for="nameEn">Name</label>
        <input type="text" value="{{isset($item) ? $item->name : ''}}" class="form-control" id="nameEn" name="title"
               required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>
    </div>

    {{--    <div class="form-group">--}}
    {{--        <label for="nameAr">Title AR</label>--}}
    {{--        <input type="text" value="{{isset($item) ? $item->title_ar : ''}}" class="form-control custom-rtl" id="nameAr" name="title_ar" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>--}}
    {{--    </div>--}}

    {{--    <div class="form-group">--}}
    {{--        <label for="descriptionEn">Description EN</label>--}}
    {{--        <textarea class="form-control" id="descriptionEn" name="description" rows="3" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}} >{{isset($item) ? $item->description : ''}}</textarea>--}}
    {{--    </div>--}}

    {{--    <div class="form-group">--}}
    {{--        <label for="descriptionAr">Description AR</label>--}}

    {{--        <textarea class="form-control custom-rtl" id="descriptionAr" name="description_ar" rows="3" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>{{isset($item) ? $item->description_ar : ''}}</textarea>--}}
    {{--    </div>--}}

    <div class="form-group">
        <label for="email">Email</label>

        <input type="email" value="{{isset($item) ? $item->title_ar : ''}}" class="form-control" id="email"
               name="email" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>
    </div>


    <div class="form-group">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status"
                required="required" {{ isset($showOnly) && $showOnly == 1 ? 'disabled' : '' }}>
            <option selected="" disabled="" value="">Choose</option>
            <option {{ isset($item) && $item->status == 1 ? 'selected' : '' }} value="1">Active</option>
            <option {{ isset($item) && $item->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
        </select>
    </div>

{{--    @if(isset($item) && !empty($item->path))--}}
{{--        <div class="form-group">--}}
{{--            <audio controls>--}}
{{--                <source src="{{isset($item) ? $item->path : ''}}" type="audio/ogg">--}}
{{--                <source src="{{isset($item) ? $item->path : ''}}" type="audio/mpeg">--}}
{{--            </audio>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="form-group">--}}
{{--        <div class="audio-upload">--}}
{{--            @if(empty($showOnly))--}}
{{--                <div class="audio-edit">--}}
{{--                    <input type='file' name="audio" id="audioUpload" accept="audio/*"/>--}}
{{--                    <label for="audioUpload"></label>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <div class="audio-preview">--}}
{{--                <audio controls id="audioPreview" style="width: 100%; display: none;">--}}
{{--                    <source src="{{ isset($item) ? $item->audio : '' }}" type="audio/ogg">--}}
{{--                    <source src="{{ isset($item) ? $item->audio : '' }}" type="audio/mpeg">--}}
{{--                    Your browser does not support the audio element.--}}
{{--                </audio>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="modal-footer">
        @if(empty($showOnly))
            <button type="submit" class="btn btn-success">{{isset($item) ? 'Update' : 'Create'}}</button>
        @endif
        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Close</button>
    </div>
</form>
<script>
    document.getElementById('audioUpload').addEventListener('change', function (event) {
        var fileInput = event.target;
        var audioPreview = document.getElementById('audioPreview');

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                audioPreview.src = e.target.result;
                audioPreview.style.display = 'block';
            };

            reader.readAsDataURL(fileInput.files[0]);
        }
    });
</script>
