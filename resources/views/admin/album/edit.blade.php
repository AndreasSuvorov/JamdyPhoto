@extends('layout.master')
@section('content')
    <div class="container pt-4">

        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1>Album @if($album)
                        bearbeiten
                    @else
                        erstellen
                    @endif</h1>
                <div class="card bg-white">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description-tab-pane" type="button" role="tab"
                                        aria-controls="description-tab-pane" aria-selected="true">Beschreibung
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="access-tab" data-bs-toggle="tab"
                                        data-bs-target="#access-tab-pane" type="button" role="tab"
                                        aria-controls="access-tab-pane" aria-selected="false">Zugriff
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="branding-tab" data-bs-toggle="tab"
                                        data-bs-target="#branding-tab-pane" type="button" role="tab"
                                        aria-controls="branding-tab-pane" aria-selected="false">Darstellung
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="uploads-tab" data-bs-toggle="tab"
                                        data-bs-target="#uploads-tab-pane" type="button" role="tab"
                                        aria-controls="uploads-tab-pane" aria-selected="false">Uploads
                                </button>
                            </li>
                        </ul>
                        <form
                            action="{{$updateUrl}}"
                            method="post">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description-tab-pane" role="tabpanel"
                                     aria-labelledby="description-tab" tabindex="0">
                                    <div class="row pt-3">
                                        <div class="col-md-12">


                                            <div class="form-group">
                                                <label for="title" class="form-label">Titel *</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                       value="{{ $album?->title }}">
                                            </div>


                                            <div class="form-group">
                                                <label for="titel" class="form-label">Album Name</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">jamdy.de/@</span>
                                                    <input type="text" class="form-control" id="slug" name="slug"
                                                           value="{{ $album?->slug }}" disabled>
                                                </div>

                                                <span>Du kann nach der Erstellung des Albums einen eigenen Namen für das Album festlegen</span>
                                            </div>

                                            <div class="form-group">
                                                <label for="titel" class="form-label">Ort</label>
                                                <input type="text" class="form-control" id="location" name="location"
                                                       value="{{ $album?->location }}"
                                                       placeholder="Wo findet das Ereignis statt? z.B. Stadthalle München">
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="form-label">Beschreibung</label>
                                                <textarea class="form-control" id="description"
                                                          placeholder="Hier kannst du eine längere Beschreibung für dein Album eintragen"
                                                          name="description">{{ $album?->description }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="titel" class="form-label">Datum</label>
                                                <input type="date" class="form-control" id="start_date"
                                                       name="start_date"
                                                       value="{{ $album?->start_date }}"
                                                       placeholder="Wann findet die Veranstaltung statt?">
                                            </div>

                                            <div class="form-group">
                                                <label for="titel" class="form-label">Ende-Datum</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date"
                                                       value="{{ $album?->end_date }}"
                                                       placeholder="Falls die Veranstaltung mehrere Tage dauert">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="access-tab-pane" role="tabpanel"
                                     aria-labelledby="access-tab"
                                     tabindex="0">
                                    <div class="row pt-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" id="active"
                                                       name="active" @checked($album?->active ?? true) >
                                                <label for="active" class="form-label">Zugriff aktiviert?</label>
                                                <p><small>Nur wenn diese Option aktiviert ist, können andere Nutzer /
                                                        Gäste
                                                        überhaupt auf das Album zugreifen, natürlich vorausgesetzt sie
                                                        kennen den Album-Code.</small></p>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="upload_active"
                                                       name="upload_active" @checked($album?->upload_active ?? true) >
                                                <label for="upload_active" class="form-label">Uploads aktiviert?</label>
                                                <p><small>Nur wenn diese Option aktivert ist, können andere Nutzer /
                                                        Gäste
                                                        neuen Medien in das Album hochladen.</small></p>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" id="download_active"
                                                       name="download_active" @checked($album?->download_active ?? true) >
                                                <label for="download_active" class="form-label">Download-Button für
                                                    Besucher
                                                    aktiviert?</label>
                                                <p><small>Nur wenn diese Option aktivert ist, können andere Nutzer /
                                                        Gäste
                                                        die Download-Buttons im Album sehen. Bitte beachte, dass Medien
                                                        trotzdem angeschaut werden können. Du selbst siehst die
                                                        Download-Buttons in deinem Album aber trotzdem.</small></p>
                                            </div>

                                            <div class="form-group">
                                                <input type="checkbox" id="download_active"
                                                       name="password_active" @checked($album?->password_active) >
                                                <label for="password_active" class="form-label">Passwortschutz
                                                    aktivieren?</label>
                                                <p><small>Aktiviert oder deaktiviert den Passwort-Schutz. Die
                                                        15-stellige,
                                                        zufällige Album-Nummer ist dir zu wenig? Schütze dein Album mit
                                                        einen Passwort gegen unberechtigte Zugriffe. Bitte gib' unten
                                                        ein
                                                        Passwort ein das Besucher benötigen, um das Album ansehen zu
                                                        können.
                                                    </small></p>
                                            </div>

                                            <div class="form-group">
                                                <label for="password" class="form-label">Passwort festlegen /
                                                    ändern?</label>
                                                <input class="form-control" type="password" id="password" disabled
                                                       name="password" value="{{$album?->password}}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="branding-tab-pane" role="tabpanel"
                                     aria-labelledby="branding-tab" tabindex="0">
                                    <div class="row pt-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="checkbox" id="show_hero_image"
                                                       name="show_hero_image" @checked($album?->show_hero_image ?? true) >
                                                <label for="show_hero_image">Vorschaubild aktiviert?</label>
                                                <p><small>Aktiviert oder deaktiviert das große Vorschaubild über dem
                                                        Album.
                                                    </small></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="uploads-tab-pane" role="tabpanel"
                                     aria-labelledby="uploads-tab" tabindex="0">
                                    <div class="row pt-3">
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label for="images_without_verification">Hochgeladene Bilder sofort
                                                    anzeigen?</label>

                                                <select class="form-control" id="images_without_verification"
                                                        name="images_without_verification">
                                                    <option value="0"
                                                            @if($album?->images_without_verification == 0) selected @endif>
                                                        Nein, manuelle überprüfung
                                                    </option>
                                                    <option value="1"
                                                            @if($album?->images_without_verification == 1) selected @endif>
                                                        Ja, zeige die Bilder sofort an
                                                    </option>
                                                </select>
                                                <p><small>Wähle aus, ob hochgeladene Bilder sofort im Album angezeigt
                                                        werden sollen oder ob du sie erst überprüfen möchtest.</small>
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card bg-warning mt-4">
                                <div class="card-body">
                                    <p>Dieses Album wird voraussichtlich
                                        am {{ now()->addDays(30)->format('d.m.Y') }} ablaufen. </p>
                                    <p>Es kann ab diesem Zeitpunkt nicht mehr geöffnet werden und wird
                                        kurz
                                        danach
                                        automatisch und unwiderruflich gelöscht.</p>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-success mt-4">
                                Album @if($album)
                                    Speichern
                                @else
                                    Erstellen
                                @endif
                            </button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script >
            // Check if all js loaded and then show notification
            // A $( document ).ready() block.
            $( document ).ready(function() {
                jQuery.notify("Access granted", "success");
            });

        </script>
    @endpush
@endsection
