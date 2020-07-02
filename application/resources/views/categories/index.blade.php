@extends('layouts.app')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Les catégories</h1>
                <p class="lead text-muted">Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam.</p>
                <p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary my-2">Ajouter une nouvelle catégories</a>
                    {{--                <a href="#" class="btn btn-secondary my-2">Secondary action</a>--}}
                </p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row">
                    <!--  Ici je vérifie si la variable $articles existe, si oui elle s'affiche et je boucle dessus-->
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <div class="col-md-4">
                                <div class="card mb-4 box-shadow">
                                    <div class="card-body">
                                        <h3>{{ $category->name }}</h3>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                                <button type="button" class="btn btn-sm btn-outline-secondary">
                                                    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                                </button>
                                            </div>
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
