@extends('layouts.app')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Modifier les caratéristiques d'une chemise</h1>
                <p class="lead text-muted">Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi
                    nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam.</p>
                <p>
                    <a href="{{ route('articles.index') }}" class="btn btn-primary my-2">Retour</a>
                    {{--                <a href="#" class="btn btn-secondary my-2">Secondary action</a>--}}
                </p>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
                @if (isset($fails))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $fails }}</li>
                        </ul>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
            <!-- Ici je précise la route ou sera traité les informations ainsi que la protection csrf et le enctype
                    afin de gérer des fichiers-->
                <form method="post" action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h5>Categories :</h5>
                            @foreach($categories as $category)
                                <label for="{{ $category->name }}">{{ $category->name }}</label>
                                <input type="checkbox" value="{{ $category->id }}" name="checkboxCategories[{{ $category->id }}]" @foreach($articleCats as $articleCat)
                                    {{ $articleCat->id == $category->id ? 'checked' : '' }} @endforeach>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $article->name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="color">Couleur</label>
                            <input type="text" class="form-control" id="color" name="color" value="{{ $article->color }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="size">Taille</label>
                            <input type="text" class="form-control" id="size" name="size" value="{{ $article->size }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">Prix</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $article->price }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $article->description }}</textarea>
                    </div>
                    <div class="col-lg-12 mt-5">
                        <label for="image">Image de la chemise</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="/storage/articles/{{ $article->image }}" alt="photo image">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <span>Modifier l'image</span>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                    </div>
                    <div class="row" style="margin: 20px">
                        <button type="submit" class="btn btn-primary">Enregistré</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@stop
