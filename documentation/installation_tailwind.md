# Installationde Tailwind et Tailwind Elements

Dans un premier temps, nous allons installer le package `webpack encore`

```bash
composer require symfony/webpack-encore-bundle
```


On installe ensuite les paquets de Node Package Manager

```bash
npm install --force
```


Dans le fichier `webpack.config.js`  il faut décommenté la ligne suivante : 

```js
.enableSassLoader()
```

Pour tester si tout fonctionne bien, il faut tester en appelant le Builder de Webpack

```bash
npm run build
```

A ce stade nous obtenons une erreur qui nous donne un indice sur quoi installer à présent

```bash
npm install sass-loader@^13.0.0 sass --save-dev
```


Dans le dossier assets/app.js on modifie l'import du CSS en modifiant son extension en SCSS

```js
import './styles/app.scss';
```


On va ensuite dans le dossier assets/styles et on modifie l'extension de `app.css` en `app.scss`.

On retire l'import de Bootstrap

On relance le Builder et il ne devrait plus trouver d'erreurs


```bash
npm run build
```

On installe Postcss qui va nous permettre d'automatiser les opérations css

```bash
npm install postcss-loader autoprefixer --dev
```

Une fois installé on créer un fichier à la racine du projet Symfony que l'on appellera `postcss.config.js`

Dans ce fichier nous tapons la commande suivante : 

```js
module.exports = {
    plugins: {
        autoprefixer: {}
    }
}
```

Retournons dans le fichier `webpack.config.js` et en dessus de la ligne décommentée plus tôt on appelle Postcss


```js
.enablePostCssLoader()
```

On peut à présent installer Tailwind CSS


```bash
npm install tailwindcss
```


Une fois installé il faut modifié le fichier `postcss.config.js` sur lequel on ajoute un plugin

```js
module.exports = {
    plugins: {
        tailwindcss: {},
        autoprefixer: {}
    }
}
```


Pour le bon fonctionnement de Tailwind, il faut générer un fichier de configuration en tapant la commande suivante : 


```bash
npx tailwindcss init
```


Dans ce fichier il faut ajouter ce que Tailwind devra traiter comme fichiers : 

```js
module.exports = {
  content: ['./templates/**/*.html.twig'],
  theme: {
    extend: {},
  },
  plugins: [],
}
```


Il faut encore importer les classes de Tailwind, pour cela il faut aller dans le fichier app.scss et ajouter les import


```scss
@import "tailwindcss/base";
@import "tailwindcss/components";
@import "tailwindcss/utilities";
```


Ensuite pour voir si tout va bien on fait un 


```bash
npm run build
npm run watch
```

`npm run watch servira à initialiser notre css`.

On va sur le site de Tailwind CSS pour prendre un Template afin de tester le bon fonctionnement.

Il faut à présent installer la surcouche de Tailwind qui se nomme Tailwind Elements


```bash
npm install tw-elements
```


Une fois de plus nous retournons dans le fichier de configuration de Tailwind afin d'y ajouter la surcouche

```js
// tailwind.config.js

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.html.twig',
    './node_modules/tw-elements/dist/js/**/*.js'
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('tw-elements/dist/plugin')
  ],
}
```


Dans le fichier `app.js` nous mettons en place notre import de Tailwind Eléments

```js
import 'tw-elements';
```

Ensuite on relance le Builder


```bash
npm run build
npm run watch
```


On teste avec un élément.