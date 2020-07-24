@extends('layouts.app')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Les Chemises</h1>
                <p class="lead text-muted">Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam.</p>
                <p>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary my-2">Ajouter une nouvelle chemise</a>
                    <a href="{{ route('categories.create') }}" class="btn btn-secondary my-2">Ajouter une nouvelle catégorie</a>
                </p>
                <p>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary my-2">Retour aux Catégories</a>
<!--                    <a href="{{ route('categories.index') }}" class="btn btn-secondary my-2">Ajouter une nouvelle catégorie</a>-->
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <h3>Voici les articles de la catégorie {{ $category->name }}</h3>
                <div class="row">
                    @if(isset($articles))
                        @foreach($articles as $article)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" src="/storage/articles/{{ $article->image }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h3>{{ $article->name }}</h3>
                                        <h5>Couleur : </h5>
                                        <p>{{ $article->color }}</p>
                                        <h5>Taille: </h5>
                                        <p class="card-text">{{ strtoupper($article->size) }}</p>
                                        <h6>Descriptif : </h6>
                                        <p class="card-text">{{ $article->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger">
                                                    <a href="{{ route('articles.destroy', $article->id) }}" class="text-white">Delete</a>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <a href="{{ route('articles.edit', $article->id) }}">Edit</a>
                                                </button>
                                            </div>
                                            <small><b>{{ $article->price }}€</b></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
@stop
