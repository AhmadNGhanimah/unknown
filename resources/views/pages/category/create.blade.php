<form class="ajax-modal-form" action="{{ isset($item) ? route('category.update', $item->id) : route('category.store') }}" id="category-form" enctype="multipart/form-data" method="post">
    @csrf
    @if(isset($item))
        @method('PUT')
        <input type="hidden" name="id" value="{{$item->id}}">
    @endif

    <div class="form-group">
        <label for="nameEn">Name EN</label>
        <input type="text" value="{{isset($item) ? $item->name : ''}}" class="form-control" id="nameEn" name="name" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>
    </div>

    <div class="form-group">
        <label for="nameAr">Name AR</label>
        <input type="text" value="{{isset($item) ? $item->name_ar : ''}}" class="form-control custom-rtl" id="nameAr" name="name_ar" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>
    </div>

    <div class="form-group">
        <label for="descriptionEn">Description EN</label>
        <textarea class="form-control" id="descriptionEn" name="description" rows="3" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}} >{{isset($item) ? $item->description : ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="descriptionAr">Description AR</label>

        <textarea class="form-control custom-rtl" id="descriptionAr" name="description_ar" rows="3" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>{{isset($item) ? $item->description_ar : ''}}</textarea>
    </div>

    <div class="form-group">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required="required" {{ isset($showOnly) && $showOnly == 1 ? 'disabled' : '' }}>
            <option selected="" disabled="" value="">Choose</option>
            <option {{ isset($item) && $item->status == 1 ? 'selected' : '' }} value="1">Active</option>
            <option {{ isset($item) && $item->status == 0 ? 'selected' : '' }} value="0">InActive</option>
        </select>
    </div>



    <div class="form-group">
        <div class="avatar-upload">
            <div class="avatar-edit">
                <input type='file' name="pic" id="imageUpload" accept="image/*" {{ isset($showOnly) && $showOnly == 1 ? 'disabled' : '' }} {{ !isset($item) ? 'required':'' }} />
                <label for="imageUpload"></label>
            </div>
            <div class="avatar-preview">
                <div id="imagePreview" style="background-image: url({{ isset($item) ? $item->image : asset('assets/images/default.png') }});">
                </div>

            </div>
        </div>
    </div>



    <div class="modal-footer">
        @if(empty($showOnly))  <button type="submit" class="btn btn-success">{{isset($item) ? 'Update' : 'Create'}}</button> @endif
        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Close</button>
    </div>
</form>
