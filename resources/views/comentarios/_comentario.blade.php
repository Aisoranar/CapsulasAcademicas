<div class="card mb-2 @isset($level) ml-{{ $level * 20 }} @endisset">
    <div class="card-body">
        <p>
            <strong>{{ $comentario->user->nombre_completo }}</strong>
            <small>
                {{ $comentario->created_at->setTimezone('America/Bogota')->format('d/m/Y h:i A') }}
            </small>
        </p>
        <p>{{ $comentario->contenido }}</p>
        <div>
            <!-- Botón para dar like -->
            <form action="{{ route('comentarios.reaccion', $comentario) }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="tipo" value="like">
                <button type="submit" class="btn btn-sm btn-outline-success">
                    Like ({{ $comentario->reacciones->where('tipo', 'like')->count() }})
                </button>
            </form>
            <!-- Botón para dar dislike -->
            <form action="{{ route('comentarios.reaccion', $comentario) }}" method="POST" style="display: inline;">
                @csrf
                <input type="hidden" name="tipo" value="dislike">
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    Dislike ({{ $comentario->reacciones->where('tipo', 'dislike')->count() }})
                </button>
            </form>
            <!-- Botón para mostrar el formulario de respuesta inline -->
            <button class="btn btn-sm btn-secondary reply-toggle" data-id="{{ $comentario->id }}">Responder</button>
        </div>
        <!-- Formulario de respuesta inline (oculto por defecto) -->
        <div class="reply-form-container mt-2" id="reply-form-{{ $comentario->id }}" style="display: none;">
            <form action="{{ route('comentarios.store') }}" method="POST">
                @csrf
                <!-- Enviar los campos polimórficos del mismo elemento (documento o cápsula) -->
                <input type="hidden" name="commentable_id" value="{{ $comentario->commentable->id }}">
                <input type="hidden" name="commentable_type" value="{{ get_class($comentario->commentable) }}">
                <!-- parent_id: el comentario actual -->
                <input type="hidden" name="parent_id" value="{{ $comentario->id }}">
                <div class="mb-2">
                    <textarea name="contenido" class="form-control" rows="2" placeholder="Escribe tu respuesta"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Enviar respuesta</button>
            </form>
        </div>
    </div>
</div>

@if($comentario->replies->count())
    <div class="ml-4">
        @foreach($comentario->replies as $reply)
            @include('comentarios._comentario', ['comentario' => $reply, 'level' => isset($level) ? $level + 1 : 1])
        @endforeach
    </div>
@endif
