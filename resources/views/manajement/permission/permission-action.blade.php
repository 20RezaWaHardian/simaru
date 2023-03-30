<div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Permission</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formAction" action="{{ $permission->id ? route('permissions.update', $permission->id) : route('permissions.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="permissionName">Permission Name</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="permissionName" value="{{$permission->name}}" name="name" placeholder="Permission Name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="guardName">Guard Name</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="guardName" value="{{$permission->guard_name}}" name="guard_name" placeholder="Guard Name">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="guardName">Main Permission</label>
                        {{-- <select name="main_permission" >
                            @foreach($main_permission as $a)
                                <option value="{{$a->id}}">{{$a->name}}</option>
                            @endforeach
                        </select> --}}
                        {{-- <input type="text" class="form-control mb-2 mr-sm-2" id="guardName" value="{{$permission->guard_name}}" name="guard_name" placeholder="Guard Name"> --}}
                    </div>
                </div>
            </div>        
        </div>
        <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
</div>