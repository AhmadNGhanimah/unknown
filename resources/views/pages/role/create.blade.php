<form class="ajax-modal-form"
      action="{{ isset($item) ? route('role.update', $item->id) : route('role.store') }}"
      id="role-form" method="post">

    @csrf

    @if(isset($item))
        @method('PUT')
        <input type="hidden" name="id" value="{{$item->id}}">
    @endif

    <div class="form-group">
        <label for="name">Role Name</label>
        <input type="text" value="{{isset($item) ? $item->name : ''}}" class="form-control" id="name" name="name"
               required>
    </div>

    <div class="row">
        @foreach($permissions as $permission)
            <div class="col-4 align-items-center d-flex flex-column"> <!-- added flex-column and align-items-start -->
                <div class="mb-2"> <!-- Added margin bottom for spacing -->
                    <p class="text-muted m-0 text-center text-nowrap">{{$permission->name}}</p>
                </div>
                <div class="d-flex justify-content-center"> <!-- Center the switch -->
                    <div class="material-switch">
                        <input id="permission-{{$permission->id}}" name="permissions[]" value="{{$permission->name}}" type="checkbox"
                               @if(isset($item->id) && $item->permissions->contains('id', $permission->id)) checked @endif>
                        <label for="permission-{{$permission->id}}" class="label-primary" style="background-color: #00cfa8 !important;"></label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <div class="modal-footer">
        <button type="submit" class="btn btn-success">{{isset($item) ? 'Update' : 'Create'}}</button>
        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Close</button>
    </div>

</form>
