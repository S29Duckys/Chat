@extends('layouts.app')

@section('title', 'Accueil')

@push('styles')
    @vite(['resources/css/home.css'])
@endpush

@vite([
    'resources/js/home/home.js'
])

@section('content')
<script>
    window.__USER__ = {
        token: @json($myId) // ou auth()->user()->token selon ton contrôleur
    };
</script>
<div id="sessionModal" class="modal hidden">

    <div class="session-popup">

        <h2>Create Session</h2>

        <div class="field">
            <label>Your token :</label>

            <div class="token-row">
                <input
                    type="text"
                    id="userToken"
                    readonly
                >

                <button id="copyTokenBtn" class="copy-btn">
                    📋
                </button>
            </div>
        </div>

        <div class="field">
            <label>Your friend token :</label>

            <input
                type="text"
                id="friendToken"
                placeholder="Paste your friend's token"
            >
        </div>

        <div class="popup-buttons">
            <button id="createSessionBtn" class="create-btn">
                Create Session
            </button>

            <button id="closeModalBtn" class="cancel-btn">
                Cancel
            </button>
        </div>

    </div>

</div>
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

                <button class="btn-primary newSessionBtn">
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
                    class="inputToken"
                        type="text"
                        placeholder="Token de session"
                    >

                    <button class="joinSession" type="button">
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