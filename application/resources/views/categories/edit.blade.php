@extends('layouts.app')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Ajouter une Categorie</h1>
                <p class="lead text-muted">Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam.</p>
                <p>
                    <!-- <a href="{{ route('articles.index') }}" class="btn btn-primary my-2">Retour</a> -->
                    {{--                <a href="#" class="btn btn-secondary my-2">Secondary action</a>--}}
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                @if(isset($message) && !empty($message))
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
            @endif
            <!-- Ici je précise la route ou sera traité les informations ainsi que la protection csrf et le enctype
                afin de gérer des fichiers-->
                <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistré</button>
                </form>

            </div>

        </div>
    </main>
@stop

