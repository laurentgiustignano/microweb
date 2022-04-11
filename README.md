# Exemple minimaliste en microservices avec Docker

Basé sur l'exemple de Xavki : https://gitlab.com/xavki/presentations_docker/-/tree/master/5-microservices

## Principe

3 conteneurs :

* 1 conteneur Nginx pour l'affichage de la page web
* 2 conteneurs pour générer une donnée (worker)

Les workers produiront une variable en bash, puis mettrons à jour la page index.html Pour ce fonctionnement, les 3
conteneurs partageront un espace de fichier avec Docker

## Installation

```bash
git clone https://github.com/laurentgiustignano/microweb.git
```

## Le serveur Nginx

On se déplace dans le répertoire `microweb`, puis on lance la construction de l'image du serveur qui s'
appellera `microweb`. Ensuite, on démarre un conteneur à partir de cette image qui s'appellera `site`.

```bash
cd microweb
docker build -t microweb .
docker run -tid -p 80:80 --name site microweb
```

Vérifier qu'aucun service sur le port 80 ne soit en cours d'exécution. Sinon, vous pouvez adapter la dernière commande
avec un autre port comme 8888

```bash
docker run -tid -p 8888:80 --name site microweb
```

Dans un navigateur web, en allant sur http://localhost ou http://localhost:8888, vous trouverez une page qui vous averti
que les workers ne sont pas encore démarré. Nous allons nous en occuper.

## Les Workers

On se déplace dans le premier répertoire `microprod1`, puis on lance la construction de l'image du worker1 qui s'
appellera `microprod1`. Même chose pour le deuxieme worker, et l'image s'appellera `microprod2`

```bash
cd microprod1
docker build -t microprod1 .
cd ..
cd microprod2
docker build -t microprod2 .
docker image ls
```

Ensuite, on va démarrer les deux workers en précisant le nom des conteneurs, et surtout en précisant qu'ils vont
partager le même volume que le conteneur déjà créé `site`.

```bash
docker run -tid --name worker1 --volumes-from site microprod1
docker run -tid --name worker2 --volumes-from site microprod2
```

À présent, en raffraichissant régulièrement la page `index.html` sur http://localhost , le travail des workers est
visible car les valeurs augmentent toutes les 5 secondes.
