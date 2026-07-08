
# ⚽ Système de Gestion de Stock - Équipe de Football

Un système web complet pour gérer l'inventaire des équipements et produits d'une équipe de football.

## 🎯 Fonctionnalités Principales

### 1. ✅ Ajouter des Produits
- Ajoutez facilement de nouveaux articles à votre inventaire
- Téléchargez des images pour chaque produit
- Définissez les catégories (Maillots, Chaussures, Ballons, Équipements, Accessoires)
- Renseignez les descriptions détaillées et quantités

### 2. 📋 Consulter l'Inventaire
- Visualisez tous vos produits dans une interface moderne et ergonomique
- Voir les images des produits
- Affichage de la quantité disponible
- Recherche rapide pour trouver les produits
- Code couleur: Rouge (Quantité faible < 5), Vert (OK)

### 3. ✏️ Modifier les Produits
- Mettez à jour les informations des produits
- Modifiez les quantités en stock
- Changez les images
- Supprimez les produits obsolètes

## 📋 Stack Technologique

- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Backend**: PHP 7.0+
- **Base de Données**: MySQL 5.7+
- **Serveur**: Apache/Nginx

## 🚀 Installation

### Prérequis
- PHP 7.0 ou supérieur
- MySQL 5.7 ou supérieur
- Apache/Nginx
- Un navigateur web moderne

### Étapes d'installation

1. **Cloner le dépôt**
   ```bash
   git clone https://github.com/oyeto223-star/gestion-stock-football.git
   cd gestion-stock-football
   ```

2. **Créer la base de données**
   - Ouvrez phpMyAdmin ou votre client MySQL préféré
   - Importez le fichier `sql/schema.sql`
   - Cela créera la base de données et les tables

   Ou exécutez directement:
   ```sql
   source sql/schema.sql;
   ```

3. **Configurer la connexion à la base de données**
   - Ouvrez `config/database.php`
   - Modifiez les paramètres selon votre configuration:
     ```php
     $servername = "localhost";    // Votre serveur MySQL
     $username = "root";            // Votre utilisateur MySQL
     $password = "";                // Votre mot de passe
     $dbname = "gestion_stock_football";
     ```

4. **Créer le dossier pour les uploads**
   ```bash
   mkdir uploads
   chmod 755 uploads
   ```

5. **Placer les fichiers sur le serveur**
   - Copiez tous les fichiers dans le répertoire racine de votre serveur web (htdocs, www, public_html, etc.)

6. **Accéder à l'application**
   - Ouvrez votre navigateur
   - Allez à: `http://localhost/gestion-stock-football` (ou votre domaine)

## 📁 Structure du Projet

```
gestion-stock-football/
│
├── config/
│   └── database.php              # Configuration de la base de données
│
├── pages/
│   ├── ajouter_produit.php       # Ajouter un produit avec image
│   ├── inventaire.php            # Voir tous les produits
│   └── modifier_produit.php      # Modifier un produit
│
├── includes/
│   ├── header.php                # En-tête (navigation)
│   └── footer.php                # Pied de page
│
├── assets/
│   ├── css/
│   │   └── style.css             # Styles CSS complets
│   └── js/
│       └── script.js             # Scripts JavaScript
│
├── uploads/                      # Dossier pour les images des produits
├── sql/
│   └── schema.sql               # Script SQL pour créer la BDD
├── index.php                     # Page d'accueil
├── README.md                     # Ce fichier
└── .gitignore                   # Fichiers à ignorer par Git
```

## 🎨 Interface Utilisateur

### Design Moderne
- Interface élaborée avec dégradés et ombres
- Responsive (adapté aux mobiles, tablettes, ordinateurs)
- Navigation intuitive
- Icônes emoji pour meilleure lisibilité

### Pages Principales
1. **Accueil** - Présentation des 3 fonctionnalités
2. **Ajouter Produit** - Formulaire pour ajouter un article
3. **Inventaire** - Grille de tous les produits
4. **Modifier Produit** - Édition complète d'un produit

## 🔐 Sécurité

- Validation des entrées utilisateur
- Protection contre les injections SQL (à améliorer avec prepared statements)
- Validation des fichiers uploadés (type et taille)
- Suppression sécurisée des fichiers

## 📝 Guide d'Utilisation

### Ajouter un Produit
1. Cliquez sur "Ajouter Produit" dans la navigation
2. Remplissez tous les champs requis
3. Téléchargez une image (JPG, PNG, GIF max 5MB)
4. Cliquez sur "Ajouter le Produit"

### Consulter l'Inventaire
1. Cliquez sur "Inventaire"
2. Visualisez tous vos produits sous forme de cartes
3. Utilisez la barre de recherche pour filtrer les produits
4. Les produits avec peu de stock apparaissent en rouge

### Modifier un Produit
1. Allez à "Inventaire"
2. Cliquez sur "Modifier" sur le produit à éditer
3. Mettez à jour les informations
4. Optionnellement, téléchargez une nouvelle image
5. Cliquez sur "Enregistrer les Modifications"

### Supprimer un Produit
1. Allez à "Inventaire"
2. Cliquez sur "Supprimer" sur le produit
3. Confirmez la suppression

## 🐛 Troubleshooting

### Problème: "Erreur de connexion à la base de données"
**Solution**: Vérifiez vos paramètres dans `config/database.php`

### Problème: Les images ne s'affichent pas
**Solution**: 
- Vérifiez que le dossier `uploads` existe et est accessible
- Vérifiez les permissions du dossier (chmod 755)

### Problème: Les uploads de fichiers ne fonctionnent pas
**Solution**:
- Créez le dossier `uploads` si nécessaire
- Vérifiez que PHP peut écrire dans ce dossier
- Vérifiez la configuration `php.ini` (upload_max_filesize)

## 🚀 Améliorations Futures

- [ ] Authentification utilisateur (login/register)
- [ ] Gestion multi-utilisateurs avec rôles
- [ ] Historique des mouvements de stock
- [ ] Rapports et statistiques avancées
- [ ] Export en PDF/Excel
- [ ] Dashboard avec graphiques
- [ ] Notifications automatiques
- [ ] API REST
- [ ] Mobile app
- [ ] Multi-langue

## 📞 Support

Pour toute question ou problème, veuillez:
1. Consulter ce README
2. Vérifier la section Troubleshooting
3. Ouvrir une issue sur GitHub

## 📄 License

Ce projet est open source et disponible sous la license MIT.

## 👨‍💻 Auteur

Développé par: **oyeto223-star**

## 🙏 Remerciements

Merci d'utiliser ce système de gestion de stock!

---

**Dernière mise à jour**: Janvier 2024
**Version**: 1.0.0
