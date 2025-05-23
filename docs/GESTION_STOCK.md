# Documentation Gestion de Stock - E-commerce Laravel

## Table des matières
1. [Structure de la base de données](#structure-de-la-base-de-données)
2. [Gestion des fournisseurs](#gestion-des-fournisseurs)
3. [Gestion des produits](#gestion-des-produits)
4. [Gestion des mouvements de stock](#gestion-des-mouvements-de-stock)
5. [Système d'alertes](#système-dalertes)

## Structure de la base de données

### Table `fournisseurs`
```php
Schema::create('fournisseurs', function (Blueprint $table) {
    $table->id();
    $table->string('nom');
    $table->string('email')->unique();
    $table->string('telephone');
    $table->string('adresse');
    $table->text('description')->nullable();
    $table->boolean('actif')->default(true);
    $table->timestamps();
});
```
Cette table stocke les informations essentielles des fournisseurs avec :
- Informations de contact (nom, email, téléphone, adresse)
- Description optionnelle
- État actif/inactif pour gérer la disponibilité

### Modification de la table `produits`
```php
Schema::table('produits', function (Blueprint $table) {
    $table->integer('seuil_alerte')->default(10)->after('quantite');
    $table->foreignId('fournisseur_id')->nullable()->after('id_categorie')
          ->constrained('fournisseurs')->nullOnDelete();
});
```
Ajouts importants :
- `seuil_alerte` : Niveau minimum de stock avant alerte
- `fournisseur_id` : Liaison avec le fournisseur (optionnelle)

### Table `mouvements_stock`
```php
Schema::create('mouvements_stock', function (Blueprint $table) {
    $table->id();
    $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade');
    $table->integer('quantite');
    $table->enum('type', ['entree', 'sortie']);
    $table->string('motif');
    $table->string('reference')->nullable();
    $table->timestamps();
});
```
Permet de tracer tous les mouvements de stock avec :
- Type de mouvement (entrée/sortie)
- Quantité concernée
- Motif du mouvement
- Référence optionnelle (bon de commande, etc.)

## Gestion des fournisseurs

### Modèle Fournisseur
```php
class Fournisseur extends Model
{
    protected $fillable = [
        'nom', 'email', 'telephone', 'adresse', 'description', 'actif'
    ];

    protected $casts = [
        'actif' => 'boolean'
    ];

    public function produits(): HasMany
    {
        return $this->hasMany(Produit::class);
    }
}
```

### Interface de gestion
Le CRUD complet permet de :
- Lister les fournisseurs avec pagination
- Créer de nouveaux fournisseurs
- Modifier les informations
- Désactiver/Supprimer des fournisseurs

## Gestion des produits

### Modèle Produit avec gestion de stock
```php
class Produit extends Model
{
    protected $fillable = [
        'libelle', 'marque', 'prixunit', 'quantite',
        'date_peremption', 'image', 'statut',
        'id_categorie', 'fournisseur_id', 'seuil_alerte'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
```

### Gestion de la date de péremption
La date de péremption est optionnelle et gérée via une interface dynamique :
```html
<div class="form-group form-check mb-3">
    <input type="checkbox" class="form-check-input" id="is_perissable" 
           name="is_perissable" onchange="toggleDatePeremption(this)">
    <label class="form-check-label" for="is_perissable">Produit périssable</label>
</div>

<div class="form-group" id="date_peremption_group">
    <label for="date_peremption">Date de péremption</label>
    <input type="date" name="date_peremption" id="date_peremption" 
           class="form-control">
</div>
```

JavaScript pour la gestion dynamique :
```javascript
function toggleDatePeremption(checkbox) {
    const dateGroup = document.getElementById('date_peremption_group');
    const dateInput = document.getElementById('date_peremption');
    
    if (checkbox.checked) {
        dateGroup.style.display = 'block';
        dateInput.setAttribute('required', 'required');
    } else {
        dateGroup.style.display = 'none';
        dateInput.removeAttribute('required');
        dateInput.value = '';
    }
}
```

## Gestion des mouvements de stock

### Contrôleur de stock
```php
class StockController extends Controller
{
    public function ajuster(Request $request, $produit_id)
    {
        $request->validate([
            'quantite' => 'required|integer',
            'type' => 'required|in:entree,sortie',
            'motif' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255'
        ]);

        try {
            DB::beginTransaction();

            $produit = Produit::findOrFail($produit_id);
            $quantite = $request->quantite;

            if ($request->type === 'sortie') {
                if ($produit->quantite < $quantite) {
                    throw new \Exception('Stock insuffisant');
                }
                $quantite = -$quantite;
            }

            // Créer le mouvement de stock
            MouvementStock::create([
                'produit_id' => $produit_id,
                'quantite' => abs($quantite),
                'type' => $request->type,
                'motif' => $request->motif,
                'reference' => $request->reference
            ]);

            // Mise à jour du stock
            $produit->increment('quantite', $quantite);
            
            DB::commit();
            return back()->with('success', 'Stock ajusté avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
```

## Système d'alertes

### Vérification des seuils
```php
public function checkStockAlerts()
{
    $produitsEnAlerte = Produit::where('quantite', '<=', DB::raw('seuil_alerte'))
        ->with('fournisseur')
        ->get();

    return view('admin.stock.alertes', compact('produitsEnAlerte'));
}
```

### Alertes de péremption
```php
public function checkPeremptionAlerts()
{
    $date_limite = now()->addDays(30);
    
    $produitsPerimes = Produit::whereNotNull('date_peremption')
        ->where('date_peremption', '<=', $date_limite)
        ->with('fournisseur')
        ->get();

    return view('admin.stock.peremption', compact('produitsPerimes'));
}
```

## Bonnes pratiques implémentées

1. **Traçabilité**
   - Tous les mouvements de stock sont enregistrés
   - Historique complet disponible pour chaque produit

2. **Sécurité**
   - Validation des données
   - Transactions pour garantir l'intégrité des données
   - Gestion des erreurs

3. **Interface utilisateur**
   - Formulaires intuitifs
   - Validation côté client et serveur
   - Confirmations pour les actions importantes
   - Gestion dynamique des champs (ex: date de péremption)

4. **Performance**
   - Pagination des listes
   - Relations Eloquent optimisées
   - Indexes sur les colonnes importantes 