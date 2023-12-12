<form class="ajax-modal-form" action="{{ isset($item) ? route('user.update', $item->id) : route('user.store') }}"
      id="audio-form" enctype="multipart/form-data" method="post">
    @csrf
    @if(isset($item))
        @method('PUT')
        <input type="hidden" name="id" value="{{$item->id}}">
    @endif


    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" value="{{isset($item) ? $item->name : ''}}" class="form-control" id="name" name="name"
               required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>
    </div>


    <div class="form-group">
        <label for="email">Email</label>

        <input type="email" value="{{isset($item) ? $item->email : ''}}" class="form-control" id="email"
               name="email" required {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" value="" class="form-control" id="password"
               name="password" {{!isset($item) ? 'required' : ''}}  {{isset($showOnly) && $showOnly == 1 ? 'readonly':''}}>
    </div>
    <div class="d-sm-flex align-items-center">
        <div class="">
            <p class="text-muted m-0">Is Admin<span class="tag">?</span></p>
        </div>
        <div class="material-switch toggle">
            <input id="SwitchSuccess" name="is_admin" value="1" type="checkbox" {{isset($item) && $item->is_admin == 1 ? 'checked':''}} {{isset($showOnly) && $showOnly == 1 ? 'disabled':''}}>
            <label for="SwitchSuccess" class="label-success"></label>
        </div>
    </div>


    <div class="form-group" id="role-section" style="{{isset($item) && $item->is_admin == 1 ? 'display: block':'display: none'}}" >
        <label for="user-role">Role</label>
        <select class="form-select select2 form-control" id="user-role"
                aria-describedby="validationServer04Feedback" name="role_id[]"
                 tabindex="-1" aria-hidden="true" {{isset($item) && $item->is_admin == 1 ? 'required':''}}>
            <option disabled="" value="">Choose...</option>
            @foreach($roles as $role)
                <option @if(isset($item->roles) && $item->roles->contains('id', $role->id)) selected
                        @endif value="{{$role->name}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div>


    <div class="modal-footer">
        @if(empty($showOnly))
            <button type="submit" class="btn btn-success">{{isset($item) ? 'Update' : 'Create'}}</button>
        @endif
        <button type="button" class="btn btn-gray" data-bs-dismiss="modal">Close</button>
    </div>
</form>
<script>
    document.getElementById('SwitchSuccess').addEventListener('change', function (event) {
        var userRole = document.getElementById('user-role');
        var roleSection = document.getElementById('role-section');

        if (this.checked) {
            roleSection.style.display = 'block';
            userRole.setAttribute('required', true);
        } else {
            roleSection.style.display = 'none';
            userRole.removeAttribute('required');
        }
    });



</script>
