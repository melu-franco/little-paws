
<section class="section section--profile-edit">
    <div class="wrapper">
        <h1>Editar Perfil</h1>
        <img src="/uploads/avatars/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" style="border-radius:50%;height:5em;width:5em;object-fit:cover;">
    
        <form method="POST" class="form" action="/profile/{{ $user->id }}/update_avatar" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
    
            <div class="form-group">
                <label for="avatar" class="button"><i class="fas fa-pen"></i></label>
                <input id="avatar" type="file" name="avatar" onChange="this.form.submit()" class="hidden">
            </div>
        </form>
    
        <form method="POST" action="/profile/{{ $user->id }}/delete_avatar" class="is-pulled-left"  enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-light"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
        </form>
    
        @if ($errors->has('avatar'))
            @foreach ($errors->all() as $error)
                <p class="help is-danger">{{ $error }}</p>
            @endforeach
        @endif
    
        <div class="is-clearfix"></div>
    
        <form method="POST" action="/profile/{{ $user->id }}">
            @method('PATCH')
            @csrf
    
            <div class="field">
                <label class="label" for="name"><i class="material-icons">person</i> Editar nombre</label>
    
                <div class="control">
                    <input type="text" class="input {{ $errors->has('content') ? 'is-danger' : '' }}" name="name" id="name" value="{{ $user->name }}">
                </div>
                @if ($errors->has('name'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
    
            <div class="form-group">
                <label class="label" for="description">Editar descripción</label>
    
                <div class="control">
                    <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="description" id="description" cols="30" rows="10">{{ $user->description }}</textarea>
                </div>
                @if ($errors->has('description'))
                    @foreach ($errors->all() as $error)
                        <p class="help is-danger">{{ $error }}</p>
                    @endforeach
                @endif
            </div>
    
            <div class="field is-pulled-left">
                <div class="control">
                    <button type="submit" class="button is-primary">Guardar</button>
                </div>
            </div>
        </form>
    
        <div class="is-pulled-left">
            <a href="{{ URL::previous() }}" class="button is-dark">Cancelar</a>
        </div>
    
        <div class="is-clearfix"></div>
    
        <form method="POST" action="/profile/{{ $user->id }}" class="is-pulled-left">
            @method('DELETE')
            @csrf
    
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-light">Eliminar cuenta</button>
                </div>
            </div>
        </form>
    </div>
</section>
