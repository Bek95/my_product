@extends('layouts.app')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Les Chemises</h1>
                <p class="lead text-muted">Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam.</p>
                <p>
                    {{--                <a href="#" class="btn btn-primary my-2">Main call to action</a>--}}
                    {{--                <a href="#" class="btn btn-secondary my-2">Secondary action</a>--}}
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    <!--  Ici je vérifie si la variable $articles existe, si oui elle s'affiche et je boucle dessus-->
                    @if(isset($articles))
                        @foreach($articles as $article)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                                    <div class="card-body">
                                        <h3>{{ $article->name }}</h3>
                                        <h4>Couleur : {{ $article->color }}</h4>
                                        <h4>Taille: {{ strtoupper($article->size) }}</h4>
                                        <p class="card-text">{{ $article->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
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
