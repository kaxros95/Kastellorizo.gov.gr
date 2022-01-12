# Styling instructions

### The file **style.css** in the root of the theme is only used as it is nescessary for the theme to work. It is **NOT USED for styling**.

/scss/main.css is the main stylesheet

To make styling changes:

1. Navigate to /scss folder
2. Make changes to the .scss files
3. [Use a SASS compiler](#markdown-header-how-to-use-a-sass-compiler) to compile main.scss to main.css

---

# How to use a SASS compiler

1. Download [Live Sass Compiler](https://marketplace.visualstudio.com/items?itemName=ritwickdey.live-sass) extension for VS Code.
2. Open VS Code JSON settings.
3. Paste settings code on a new line.
4. Click the button at the bottom right of VS Code "Watch SASS". As soon as it displays "Watching...", you are ready to make changes to .scss files.

**Settings code:** The following code will specify the format of the compiled css file (expanded), the extension (.css) and the path that will be compiled to (scss folder).

```sh
"liveSassCompile.settings.generateMap": false,
"liveSassCompile.settings.formats": [
  {
    "format": "expanded",
    "extensionName": ".css",
    "savePath": "/scss/"
  }
],
```

---

NOTE: Files that are prefixed with \_ (underscore) are partial files. They will not get compiled directly. These are used for import in main.scss and will be included when that file will be compiled.

Please **don't make direct changes** to /scss/main.css as this will mess up the scss environment.
