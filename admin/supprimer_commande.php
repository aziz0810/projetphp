<?php
include '../includes/config.php';
include '../includes/auth.php';
verifierConnexion();
verifierAdmin();

if (!isset($_GET['id'])) {
    header('Location: commandes.php');
    exit;
}

$id = $_GET['id'];

try {
    // Supprimer les produits associés à la commande
    $sql = "DELETE FROM commande_produits WHERE commande_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    // Supprimer la commande
    $sql = "DELETE FROM commandes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    header('Location: commandes.php');
    exit;
} catch (PDOException $e) {
    die("Erreur lors de la suppression de la commande : " . $e->getMessage());
}
?>