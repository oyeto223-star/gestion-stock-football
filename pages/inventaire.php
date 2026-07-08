<?php
include '../includes/header.php';
include '../config/database.php';

$message = '';
$messageType = '';
$searchTerm = '';

// Récupérer la recherche
if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search']);
}

// Récupérer les produits
$sql = "SELECT * FROM produits";
if (!empty($searchTerm)) {
    $sql .= " WHERE nom LIKE '%$searchTerm%' OR categorie LIKE '%$searchTerm%'";
}
$sql .= " ORDER BY date_creation DESC";

$result = $conn->query($sql);
$produits = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produits[] = $row;
    }
}

// Gestion de la suppression
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Récupérer l'image pour la supprimer
    $sqlSelect = "SELECT image FROM produits WHERE id = $id";
    $resultSelect = $conn->query($sqlSelect);
    
    if ($resultSelect && $resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
        $imagePath = '../uploads/' . $row['image'];
        
        // Supprimer l'image
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        
        // Supprimer de la base de données
        $sqlDelete = "DELETE FROM produits WHERE id = $id";
        if ($conn->query($sqlDelete) === TRUE) {
            $message = "✅ Produit supprimé avec succès!";
            $messageType = "success";
            header("Refresh: 2; url=inventaire.php");
        } else {
            $message = "Erreur lors de la suppression: " . $conn->error;
            $messageType = "error";
        }
    }
}
?>

<div class="container">
    <h2 class="page-title">📋 Inventaire des Produits</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; justify-content: center;">
        <form method="GET" style="display: flex; gap: 0.5rem; width: 100%; max-width: 500px;">
            <input type="text" name="search" placeholder="🔍 Rechercher un produit..." 
                   value="<?php echo $searchTerm; ?>" style="flex: 1; padding: 0.75rem; border: 2px solid white; border-radius: 5px;">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            <?php if (!empty($searchTerm)): ?>
                <a href="inventaire.php" class="btn btn-secondary">Réinitialiser</a>
            <?php endif; ?>
        </form>
    </div>

    <?php if (count($produits) > 0): ?>
        <div class="inventory-grid">
            <?php foreach ($produits as $produit): ?>
                <div class="product-card">
                    <?php if (!empty($produit['image'])): ?>
                        <img src="../uploads/<?php echo htmlspecialchars($produit['image']); ?>" 
                             alt="<?php echo htmlspecialchars($produit['nom']); ?>" class="product-image">
                    <?php else: ?>
                        <div class="product-image" style="display: flex; align-items: center; justify-content: center; background: #ecf0f1; color: #95a5a6;">
                            Pas d'image
                        </div>
                    <?php endif; ?>

                    <div class="product-info">
                        <h3 class="product-name"><?php echo htmlspecialchars($produit['nom']); ?></h3>
                        
                        <p style="font-size: 0.85rem; color: #7f8c8d; margin-bottom: 0.5rem;">
                            <strong>Catégorie:</strong> <?php echo htmlspecialchars($produit['categorie']); ?>
                        </p>

                        <p class="product-description"><?php echo htmlspecialchars($produit['description']); ?></p>

                        <div class="product-quantity <?php echo $produit['quantite'] < 5 ? 'low' : 'ok'; ?>">
                            📦 Quantité: <strong><?php echo $produit['quantite']; ?> unité(s)</strong>
                        </div>

                        <p style="font-size: 0.8rem; color: #95a5a6; margin-bottom: 1rem;">
                            Ajouté le: <?php echo date('d/m/Y H:i', strtotime($produit['date_creation'])); ?>
                        </p>

                        <div class="product-actions">
                            <a href="modifier_produit.php?id=<?php echo $produit['id']; ?>" class="btn btn-info">✏️ Modifier</a>
                            <a href="inventaire.php?action=delete&id=<?php echo $produit['id']; ?>" 
                               class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">🗑️ Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div style="background: white; padding: 3rem; text-align: center; border-radius: 10px;">
            <p style="font-size: 1.2rem; color: #7f8c8d;">
                <?php echo empty($searchTerm) ? "Aucun produit pour le moment. Commencez par en ajouter!" : "Aucun produit ne correspond à votre recherche."; ?>
            </p>
            <a href="ajouter_produit.php" class="btn btn-primary" style="margin-top: 1rem; display: inline-block;">Ajouter un Produit</a>
        </div>
    <?php endif; ?>
</div>

<script src="../assets/js/script.js"></script>
<?php
include '../includes/footer.php';
?>
