@extends('layouts.app')

@section('content')
    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Ajouter une chemise</h1>
                <p class="lead text-muted">Sed laeditur hic coetuum magnificus splendor levitate paucorum incondita, ubi nati sunt non reputantium, sed tamquam indulta licentia vitiis ad errores lapsorum ac lasciviam.</p>
                <p>
                    <a href="{{ route('articles.index') }}" class="btn btn-primary my-2">Retour</a>
                    {{--                <a href="#" class="btn btn-secondary my-2">Secondary action</a>--}}
                </p>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
            <!-- Ici je précise la route ou sera traité les informations ainsi que la protection csrf et le enctype
                afin de gérer des fichiers-->
                <form method="post" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6" style="padding-top: 37px">
                            <a href="{{ route('categories.create') }}">Créer une nouvelle catégorie</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="category_first">Categories</label>
                            <select id="category_first" class="form-control" name="category_first" required>
                                <option selected value="choice_cat1">Choose...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category_second">Categories additionnelles</label>
                            <select id="category_second" class="form-control" name="category_second">
                                <option selected value="choice_cat2">Choose...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="color">Couleur</label>
                            <input type="text" class="form-control" id="color" name="color">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="size">Taille</label>
                            <select id="size" class="form-control" name="size">
                                <option selected>Choose...</option>
                                <option>S</option>
                                <option>L</option>
                                <option>XL</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="price">Prix</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Choisir un fichier</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistré</button>
                </form>
            </div>
        </div>
    </main>
@stop
