<div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="formAction" action="{{ $navigation->id ? route('menus.update', $navigation->id) : route('menus.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menuName">Name</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="menuName" value="{{$navigation->name}}" name="name" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mainMenu">Main Menu </label>
                            <select class="form-control" data-toggle="select" id="mainMenu" value="{{$navigation->main_menu}}" name="main_menu">
                                <option  disabled selected>Pilih...</option>
                                @foreach($menus as $menu)
                                <option {{ $menu->id == $navigation->main_menu ? 'selected' : '' }} value="{{$menu->id}}"> {{$menu->name}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" value="{{$navigation->url}}" name="data_url" placeholder="Url">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control mb-2 mr-sm-2" id="icon" value="{{$navigation->icon}}" name="icon" placeholder="Icon">
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