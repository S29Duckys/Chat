@extends('layouts.app')

@section('title', 'Accueil')

@push('styles')
    @vite(['resources/css/home.css'])
@endpush

@section('content')
<div class="landing-page">

    <!-- Header -->
    <header class="topbar">
        <div class="brand">
            <div class="logo">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24">
                    <path d="M7 10V7a5 5 0 0110 0v3" stroke="currentColor" stroke-width="2"/>
                    <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="2"/>
                </svg>
            </div>
            <span>CipherChat</span>
        </div>

        <div class="badge">
            🔒 End-to-end encrypted
        </div>
    </header>

    <!-- Hero -->
    <main class="hero">

        <div class="small-badge">
            Sessions éphémères · zéro trace
        </div>

        <h1>
            Messagerie chiffrée,<br>
            <span>de bout en bout.</span>
        </h1>

        <p class="subtitle">
            Créez une session privée ou rejoignez-en une avec un token.
            <br>
            Vos messages restent entre vous — personne d'autre, jamais.
        </p>

        <!-- Cards -->
        <div class="cards">

            <!-- Create Session -->
            <div class="card">
                <div class="icon-box">
                    +
                </div>

                <h3>Créer une session</h3>

                <p>
                    Génère un token unique à partager avec vos contacts.
                </p>

                <button class="btn-primary">
                    Nouvelle session
                </button>
            </div>

            <!-- Join Session -->
            <div class="card">
                <div class="icon-box">
                    🔑
                </div>

                <h3>Rejoindre une session</h3>

                <p>
                    Collez le token reçu pour accéder à la conversation.
                </p>

                <form class="join-form">
                    <input
                        type="text"
                        placeholder="Token de session"
                    >

                    <button type="submit">
                        Rejoindre
                    </button>
                </form>
            </div>

        </div>

        <p class="footer-note">
            Aucun compte requis. Les sessions expirent automatiquement.
        </p>

    </main>

</div>
@endsection