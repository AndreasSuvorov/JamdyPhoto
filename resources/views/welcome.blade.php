@extends('layout.master')
@section('content')
    <div id="app">

        <main>
            <div style="background-color: #F46531">
                <div class="row">
                    <div class="col">
                        <div class="container" style="    padding: 20vh 15px;">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <x-header.logo type="white" size="xl"/>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    <span class="text-white text-center">Fotos & Videos. Einfach. Online teilen & tauschen.</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center ">
                                    <span class="text-white text-center">ist ein neuer und einfacher Weg, um Fotos von mehreren Personen einfach zu sammeln, zu ordnen und zu teilen.
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4 d-flex justify-content-end">
                                    <a class="btn btn-outline text-white">Ein Album öffnen</a>
                                </div>
                                <div class="col-md-4 d-flex justify-content-center">
                                    <a class="btn btn-success text-white">Ein Album erstellen</a>
                                </div>
                                <div class="col-md-4 ">
                                    <a class="btn btn-outline text-white">Mehr erfahren</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <section class="pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto ">
                        <h2 class="text-center">Fotos ohne Registrierung austauschen.</h2>
                        <p class="text-center">
                            Mit können Sie Fotos und Videos mit Freunden und Familie teilen, ohne sich registrieren zu müssen. Erstellen Sie einfach ein Album und teilen Sie den Link mit Ihren Freunden. Sie können dann Fotos und Videos hochladen, ohne sich registrieren zu müssen.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                ICON
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3>Album erstellen</h3>
                                <p>Erstellen Sie ein Album und laden Sie Fotos und Videos hoch. Teilen Sie den Link mit Ihren Freunden und lassen Sie sie Fotos und Videos hochladen.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                ICON
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3>Album öffnen</h3>
                                <p >Öffnen Sie ein Album, indem Sie den Link eingeben, den Sie von einem Freund erhalten haben. Sie können dann Fotos und Videos hochladen.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                ICON
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h3>Album teilen</h3>
                                <p>Teilen Sie den Link zu einem Album mit Ihren Freunden und lassen Sie sie Fotos und Videos hochladen.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
