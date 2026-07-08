-- Base de données pour la gestion de stock

CREATE DATABASE IF NOT EXISTS gestion_stock_football;
USE gestion_stock_football;

-- Créer la table des produits
CREATE TABLE IF NOT EXISTS produits (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    quantite INT NOT NULL DEFAULT 0,
    categorie VARCHAR(100) NOT NULL,
    image VARCHAR(255),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_categorie (categorie),
    INDEX idx_quantite (quantite)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insérer quelques données de test
INSERT INTO produits (nom, description, quantite, categorie, image) VALUES
('Maillot Domicile', 'Maillot officiel domicile saison 2024-2025', 50, 'maillots', ''),
('Ballon de Match', 'Ballon officiel UEFA pour matches officiels', 15, 'ballons', ''),
('Crampons Pro', 'Crampons professionnels dernière génération', 30, 'chaussures', ''),
('Protège-tibias', 'Protecteurs certifiés FIFA', 25, 'equipements', ''),
('Gants Gardien', 'Gants pour gardiens de but haute performance', 10, 'accessoires', '');
