@extends('layouts.app')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Bienvenue sur le top de chez top en matière de chemises pour homme</h1>
                <p class="lead text-muted">Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita,
                    ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum
                    ac lasciviam.</p>
                <p>
                    <a href="{{ route('articles.index') }}" class="btn btn-primary my-2">Voir les chemises</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary my-2">Voir les catégories</a>
                </p>
            </div>
        </section>
    </main>
@stop
