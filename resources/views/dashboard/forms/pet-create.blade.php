<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content pet-create">

        <div class="modal-header d-flex">
            <h4 class="modal-title"><i class="fas fa-paw"></i> Agregar mascota</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

            <form method="POST" class="form" action="{{ route('pet.store') }}" enctype="multipart/form-data">
                @csrf
    
                <div class="form-group pets w-pad">
                    <h2 class="title title--medium -mayus">Tipo de mascota</h2>
                    <div class="pets__pet d-flex flex-wrap">
                        @foreach ($pet_types as $pet)
                            <input class="hidden" type="radio" name="pet_type_id" value="{{$pet->id}}" id="pet-{{$pet->id}}">
                            <label class="pet pet-{{$pet->id}}" for="pet-{{$pet->id}}">
                                <img src="/img/pets_avatars/{{$pet->avatar}}" alt="{{$pet->title}}">
                                {{$pet->title}}
                            </label>
                        @endforeach
                    </div>
                </div>
    
                <div class="form-group avatar w-pad">
                    <div class="setting image_picker">
                        <div class="settings_wrap d-flex">
                            <label class="drop_target">
                                <div class="image_preview"></div>
                                <input id="inputFile" name="avatar" type="file"/>
                            </label>
                            <div class="settings_actions vertical">
                                <label for="inputFile" class="choose-file"><i class="fa fa-picture-o"></i> Subir archivo</label>
                                <a class="disabled" data-action="remove_current_image"><i class="fa fa-ban"></i> Eliminar archivo</a>
                            </div>
                        </div>
                    </div>
    
                    @if ($errors->has('avatar'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('avatar') }}</strong>
                        </span>
                    @endif
                </div>
    
                <div class="form-group w-pad">
                    <label for="name" class="label"><i class="material-icons">person</i>Nombre</label>
    
                    <input id="name" type="text" placeholder="Escribir nombre.." class="input user {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus>
    
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
    
                <div class="form-group w-pad">
                    <label class="label" for="description"><i class="material-icons">create</i>Descripción</label>
    
                    <div class="control">
                        <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" placeholder="Escribir descripción.." name="description" id="description" cols="30" rows="5"></textarea>
                    </div>
                    @if ($errors->has('description'))
                        @foreach ($errors->all() as $error)
                            <p class="help is-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
    
                <div class="form-group w-pad">
                    <button type="submit" class="btn btn-round -large -blue">
                        Crear
                    </button>
                </div>
    
    
            </form>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>

        </div>

    </div>
