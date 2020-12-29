<?php

use Illuminate\Database\Seeder;
use App\Models\{Permission,User,Profile};

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('permissions')->insert([
            [
                'name' => 'Editer son profil',
                'slug' => 'edit-profile',
            ],
            [
                'name' => 'Mettre à jour son profil',
                'slug' => 'update-profile',
            ],// Profile permissions ---------------------
            [
                'name' => 'Lister les users',
                'slug' => 'index-user',
            ],
            [
                'name' => 'Rechercher un user',
                'slug' => 'search-user',
            ],
            [
                'name' => 'Créer un user',
                'slug' => 'create-user',
            ],
            [
                'name' => 'Enrregistrer un user',
                'slug' => 'store-user',
            ],
            [
                'name' => 'Editer un user',
                'slug' => 'edit-user',
            ],
            [
                'name' => 'Changer le statut d\'un user',
                'slug' => 'status-user',
            ],
            [
                'name' => 'Mettre à jour un user',
                'slug' => 'update-user',
            ],
            [
                'name' => 'Supprimer un user',
                'slug' => 'destroy-user',
            ],// Profiles
            [
                'name' => 'Lister les profils',
                'slug' => 'index-prof',
            ],
            [
                'name' => 'Rechercher un profile',
                'slug' => 'search-prof',
            ],
            [
                'name' => 'Créer un profile',
                'slug' => 'create-prof',
            ],
            [
                'name' => 'Enrregistrer un profile',
                'slug' => 'store-prof',
            ],
            [
                'name' => 'Editer un profile',
                'slug' => 'edit-prof',
            ],
            [
                'name' => 'Changer le statut d\'un profile',
                'slug' => 'status-prof',
            ],
            [
                'name' => 'Mettre à jour un profile',
                'slug' => 'update-prof',
            ],
            [
                'name' => 'Supprimer un profile',
                'slug' => 'destroy-prof',
            ],// Components permissions ---------------------
            [
                'name' => 'Lister les permissions',
                'slug' => 'index-permission',
            ],
            [
                'name' => 'Rechercher une permission',
                'slug' => 'search-permission',
            ],
            [
                'name' => 'Créer une permission',
                'slug' => 'create-permission',
            ],
            [
                'name' => 'Enrregistrer une permission',
                'slug' => 'store-permission',
            ],
            [
                'name' => 'Editer une permission',
                'slug' => 'edit-permission',
            ],
            [
                'name' => 'Mettre à jour une permission',
                'slug' => 'update-permission',
            ],
            [
                'name' => 'Supprimer une permission',
                'slug' => 'destroy-permission',
            ],// Permission permissions ---------------------
            [
                'name' => 'Visualiser tableau de bord',
                'slug' => 'list-dashboard',
            ],
            [
                'name' => 'Visualiser GAB',
                'slug' => 'list-gab',
            ],
            [
                'name' => 'Lister les transactions',
                'slug' => 'list-transaction',
            ],
            [
                'name' => 'Rechercher transaction',
                'slug' => 'search-transaction',
            ],
            [
                'name' => 'Exporter transaction',
                'slug' => 'export-transaction',
            ],// Chemin
            [
                'name' => 'Lister les chemins',
                'slug' => 'index-path',
            ],
            [
                'name' => 'Rechercher un chemin',
                'slug' => 'search-path',
            ],
            [
                'name' => 'Créer un chemin',
                'slug' => 'create-path',
            ],
            [
                'name' => 'Enrregistrer un chemin',
                'slug' => 'store-path',
            ],
            [
                'name' => 'Editer un chemin',
                'slug' => 'edit-path',
            ],
            [
                'name' => 'Changer le statut d\'un chemin',
                'slug' => 'status-path',
            ],
            [
                'name' => 'Mettre à jour un chemin',
                'slug' => 'update-path',
            ],
            [
                'name' => 'Supprimer un chemin',
                'slug' => 'destroy-path',
            ],// Gab
            [
                'name' => 'Lister les gabs',
                'slug' => 'index-gab',
            ],
            [
                'name' => 'Rechercher un gab',
                'slug' => 'search-gab',
            ],
            [
                'name' => 'Créer un gab',
                'slug' => 'create-gab',
            ],
            [
                'name' => 'Enrregistrer un gab',
                'slug' => 'store-gab',
            ],
            [
                'name' => 'Editer un gab',
                'slug' => 'edit-gab',
            ],
            [
                'name' => 'Changer le statut d\'un gab',
                'slug' => 'status-gab',
            ],
            [
                'name' => 'Mettre à jour un gab',
                'slug' => 'update-gab',
            ],
            [
                'name' => 'Supprimer un gab',
                'slug' => 'destroy-gab',
            ],// Prestataire
            [
            'name' => 'Lister les prestataires',
            'slug' => 'index-prestataire',
            ],
            [
                'name' => 'Rechercher un prestataire',
                'slug' => 'search-prestataire',
            ],
            [
                'name' => 'Créer un prestataire',
                'slug' => 'create-prestataire',
            ],
            [
                'name' => 'Enrregistrer un prestataire',
                'slug' => 'store-prestataire',
            ],
            [
                'name' => 'Editer un prestataire',
                'slug' => 'edit-prestataire',
            ],
            [
                'name' => 'Changer le statut d\'un prestataire',
                'slug' => 'status-prestataire',
            ],
            [
                'name' => 'Mettre à jour un prestataire',
                'slug' => 'update-prestataire',
            ],
            [
                'name' => 'Supprimer un prestataire',
                'slug' => 'destroy-prestataire',
            ],// Prestation
            [
                'name' => 'Lister les prestations',
                'slug' => 'index-prestation',
            ],
            [
                'name' => 'Rechercher une prestation',
                'slug' => 'search-prestation',
            ],
            [
                'name' => 'Créer une prestation',
                'slug' => 'create-prestation',
            ],
            [
                'name' => 'Enrregistrer une prestation',
                'slug' => 'store-prestation',
            ],
            [
                'name' => 'Editer une prestation',
                'slug' => 'edit-prestation',
            ],
            [
                'name' => 'Mettre à jour une prestation',
                'slug' => 'update-prestation',
            ],
            [
                'name' => 'Supprimer une prestation',
                'slug' => 'destroy-prestation',
            ],// Dashboard
            [
                'name' => 'Recherche tableau de bord',
                'slug' => 'search-dashboard',
            ],
            [
                'name' => 'Lister chargements de GAB',
                'slug' => 'charge-gab',
            ],
            [
                'name' => 'Lister Erreurs de GAB',
                'slug' => 'error-gab',
            ],
            [
                'name' => 'Recherche chargements',
                'slug' => 'search-charge',
            ],
            [
                'name' => 'Recherche erreur',
                'slug' => 'search-error',
            ],// Type prestation
            [
                'name' => 'Lister les types prestations',
                'slug' => 'index-typeprestation',
            ],
            [
                'name' => 'Rechercher un type de prestation',
                'slug' => 'search-typeprestation',
            ],
            [
                'name' => 'Créer un type de prestation',
                'slug' => 'create-typeprestation',
            ],
            [
                'name' => 'Enrregistrer un type de prestation',
                'slug' => 'store-typeprestation',
            ],
            [
                'name' => 'Editer un type de prestation',
                'slug' => 'edit-typeprestation',
            ],
            [
                'name' => 'Mettre à jour un type de prestation',
                'slug' => 'update-typeprestation',
            ],
            [
                'name' => 'Supprimer un type de prestation',
                'slug' => 'destroy-typeprestation',
            ]
        ]);
    }
}
