<?php
include 'includes/header.php';
?>

<div class="home-container">
    <div class="container">
        <h1 class="home-title">⚽ Bienvenue dans le Système de Gestion de Stock</h1>
        <p class="home-subtitle">Gérez efficacement votre inventaire sportif</p>

        <div class="home-features">
            <div class="feature-card">
                <div class="feature-icon">📦</div>
                <h3 class="feature-title">Ajouter des Produits</h3>
                <p class="feature-description">Ajoutez facilement des articles avec images et descriptions détaillées</p>
                <a href="pages/ajouter_produit.php" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Commencer</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <h3 class="feature-title">Voir l'Inventaire</h3>
                <p class="feature-description">Consultez tous vos produits avec leurs quantités disponibles</p>
                <a href="pages/inventaire.php" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Consulter</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">✏️</div>
                <h3 class="feature-title">Modifier les Produits</h3>
                <p class="feature-description">Mettez à jour les quantités et les informations des produits</p>
                <a href="pages/inventaire.php" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Gérer</a>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
