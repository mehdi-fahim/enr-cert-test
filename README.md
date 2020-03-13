# ENR'CERT Technique

Ce projet est un tests technique pour l'entreprise ENR'CERT

### Pré-requis

- Docker (optionnel)
- un editeur web
- PHP 7.2 min.
- MySQL 5.8 min.

### URL 

- Web : localhost:8000
- database : localhost:3306
- phpMyAdmin : localhost:8080

### Installation via Docker

- créer un fichier .env avec dedans

```shell
MYSQL_ROOT_PASSWORD=motdepasse
MYSQL_ROOT_USER=nomdelutilisateur
```

- Entré dans le dossier enr-cert-test-technique
et lancé la commande ```./dockerkit install```

- Pour lancé le projet ```./dockerkit up``` 

### Installation standard

- créer un fichier .env avec dedans

```shell
MYSQL_ROOT_PASSWORD=motdepasse
MYSQL_ROOT_USER=nomdelutilisateur
```

Entré dans le dossier ```enr-cert-test-technique/Lab```

- Modifier la DATABASE_URL dans le .env

- ```composer install```

- ```php bin/console doctrine:schema:update --force```

- ```php bin/console doctrine:fixtures:load```

une fois que c'est fais vous pouvez lancé le projet ```php bin/console server:run```

## Installation du bundle pour la gestion des JWT

- ```composer require lexik/jwt-authentication-bundle```

- Générer une clé publique et privée avec une passphrase à reporter dans le .env

```
$ mkdir -p config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ open
```

### Routes

```php
localhost:8000/api/cars => Get all cars
localhost:8000/api/cars/{id} => Get one cars
localhost:8000/api/create/cars => Create cars
localhost:8000/api/edit/cars/{id} => Update cars
localhost:8000/api/delete/cars/{id} => Delete cars
```
Body de la requète (pour la création et la mise à jour)

```json
{
  "marque": "Citroen",
  "modele": "C4",
  "annee": 2010,
  "prix": 4600,
  "date_circulation": "10-10-2010",
  "kilometrage": 107000,
  "carburant": "Essence",
  "boite_vitesse": "Manuelle",
  "couleur": "Vert",
  "nombre_portes": 5,
  "nombre_places": 5,
  "puissance_fiscale": 6,
  "puissance_din": 90,
  "permis": true
}
```

## Informations de connexion

Utilisateurs créés via les fixtures :
- admin@attineos.com / admin
- user@attineos.com / user

##### Justification techniques

J'ai utilisé docker pour garder le même environement sur tout les OS