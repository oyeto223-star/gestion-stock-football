<?php
include '../includes/header.php';
include '../config/database.php';

$message = '';
$messageType = '';
$produit = null;

// Vérifier que l'ID est fourni
if (!isset($_GET['id'])) {
    header('Location: inventaire.php');
    exit;
}

$id = intval($_GET['id']);

// Récupérer les informations du produit
$sql = "SELECT * FROM produits WHERE id = $id";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    header('Location: inventaire.php');
    exit;
}

$produit = $result->fetch_assoc();

// Traiter la modification
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $quantite = isset($_POST['quantite']) ? intval($_POST['quantite']) : 0;
    $categorie = isset($_POST['categorie']) ? htmlspecialchars($_POST['categorie']) : '';

    // Validation
    if (empty($nom) || empty($description) || $quantite < 0 || empty($categorie)) {
        $message = "Veuillez remplir tous les champs correctement!";
        $messageType = "error";
    } else {
        $imageName = $produit['image'];

        // Gestion de la nouvelle image
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../uploads/';
            $fileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($fileType, $allowedTypes)) {
                $message = "Format d'image non autorisé! Utilisez JPG, PNG ou GIF.";
                $messageType = "error";
            } elseif ($_FILES['image']['size'] > 5000000) { // 5MB max
                $message = "L'image est trop grande! Maximum 5MB.";
                $messageType = "error";
            } else {
                // Supprimer l'ancienne image
                $oldImagePath = $uploadDir . $produit['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                $imageName = time() . '.' . $fileType;
                $imagePath = $uploadDir . $imageName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $message = "Erreur lors de l'upload de l'image!";
                    $messageType = "error";
                    $imageName = $produit['image'];
                }
            }
        }

        // Mettre à jour la base de données
        if ($messageType !== 'error') {
            $sql = "UPDATE produits SET 
                    nom = '$nom',
                    description = '$description',
                    quantite = $quantite,
                    categorie = '$categorie',
                    image = '$imageName'
                    WHERE id = $id";

            if ($conn->query($sql) === TRUE) {
                $message = "✅ Produit modifié avec succès!";
                $messageType = "success";

                // Rafraîchir les données
                $produit['nom'] = $nom;
                $produit['description'] = $description;
                $produit['quantite'] = $quantite;
                $produit['categorie'] = $categorie;
                $produit['image'] = $imageName;
            } else {
                $message = "Erreur lors de la modification: " . $conn->error;
                $messageType = "error";
            }
        }
    }
}
?>

<div class="container">
    <h2 class="page-title">✏️ Modifier le Produit</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom du Produit *</label>
                <input type="text" id="nom" name="nom" required value="<?php echo htmlspecialchars($produit['nom']); ?>">
            </div>

            <div class="form-group">
                <label for="description">Description *</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($produit['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie *</label>
                <select id="categorie" name="categorie" required>
                    <option value="">-- Choisir une catégorie --</option>
                    <option value="maillots" <?php echo $produit['categorie'] === 'maillots' ? 'selected' : ''; ?>>Maillots</option>
                    <option value="chaussures" <?php echo $produit['categorie'] === 'chaussures' ? 'selected' : ''; ?>>Chaussures</option>
                    <option value="ballons" <?php echo $produit['categorie'] === 'ballons' ? 'selected' : ''; ?>>Ballons</option>
                    <option value="equipements" <?php echo $produit['categorie'] === 'equipements' ? 'selected' : ''; ?>>Équipements</option>
                    <option value="accessoires" <?php echo $produit['categorie'] === 'accessoires' ? 'selected' : ''; ?>>Accessoires</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantite">Quantité *</label>
                <input type="number" id="quantite" name="quantite" min="0" required value="<?php echo $produit['quantite']; ?>">
            </div>

            <div class="form-group">
                <label for="image">Nouvelle Image (optionnel)</label>
                <input type="file" id="image" name="image" accept="image/*">
                <small style="color: #7f8c8d;">Format: JPG, PNG, GIF | Taille max: 5MB</small>
            </div>

            <div style="margin: 1.5rem 0; text-align: center;">
                <p style="color: #7f8c8d; margin-bottom: 0.5rem;">Image actuelle:</p>
                <?php if (!empty($produit['image'])): ?>
                    <img src="../uploads/<?php echo htmlspecialchars($produit['image']); ?>" 
                         alt="<?php echo htmlspecialchars($produit['nom']); ?>" 
                         style="max-width: 200px; max-height: 200px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <?php else: ?>
                    <p style="color: #95a5a6;">Pas d'image</p>
                <?php endif; ?>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">✅ Enregistrer les Modifications</button>
                <a href="inventaire.php" class="btn btn-secondary">Retour</a>
            </div>
        </form>
    </div>
</div>

<script src="../assets/js/script.js"></script>
<?php
include '../includes/footer.php';
?>
