<!-- markdownlint-disable MD033 -->
**Español** · [English](README.md)

# Freedom ATE — tema para Omeka S

Tema de Omeka S para **ATE Educación** (Área de Tecnología Educativa, Consejería de
Educación del Gobierno de Canarias), usado en un **servicio de repositorio de recursos
digitales para centros educativos públicos**.

Es un fork del tema [Freedom](https://github.com/omeka-s-themes/freedom), adaptado a las
necesidades de ese servicio: identidad institucional, herramientas de edición para el
profesorado, una experiencia de navegación y búsqueda más rica, y localización al español.

<a href="https://ateeducacion.github.io/omeka-s-playground/?blueprint=https%3A%2F%2Fraw.githubusercontent.com%2Fateeducacion%2Fomeka-s-theme-freedom-ate%2Frefs%2Fheads%2Fmaster%2Fblueprint.json">
  <img src="https://raw.githubusercontent.com/ateeducacion/omeka-s-theme-freedom-ate/refs/heads/master/.github/assets/playground-preview-button.svg" alt="Probar Freedom ATE en el navegador" width="224">
</a><br>
<small><a href="https://ateeducacion.github.io/omeka-s-playground/?blueprint=https%3A%2F%2Fraw.githubusercontent.com%2Fateeducacion%2Fomeka-s-theme-freedom-ate%2Frefs%2Fheads%2Fmaster%2Fblueprint.json">Probar en el navegador</a></small>

---

## Origen y atribución

Este tema **no** es una obra original. Desciende del tema Freedom para Omeka S, y el
historial de este repositorio empieza con los commits de ese mismo tema.

| | |
|---|---|
| **Tema original** | [Freedom](https://github.com/omeka-s-themes/freedom), desarrollado también en [nelsonamaya82/theme-freedom](https://github.com/nelsonamaya82/theme-freedom) |
| **Autor original** | Nelson Amaya — [Out of the Bugs](https://www.outofthebugs.com) |
| **Con aportaciones de** | El equipo de Omeka en [RRCHNM](https://rrchnm.org) (Roy Rosenzweig Center for History and New Media) |
| **Plataforma** | [Omeka S](https://omeka.org/s/), de RRCHNM |
| **Este fork** | ATE Educación, Gobierno de Canarias |

El mérito del diseño y de la gran mayoría del código corresponde al proyecto original.
Los problemas relativos a este fork deben reportarse aquí, no a sus autores.

### Cambios introducidos en este fork

La GPL pide que las versiones modificadas indiquen de forma visible que lo han sido, así
que estas son las diferencias sustantivas respecto al original:

- **Identidad institucional** — logotipo institucional configurable en la barra superior
  de la cabecera, y enlace opcional a la página de inicio del servicio.
- **Herramientas de edición** — acciones de editar, añadir medios y eliminar para las
  personas con permisos de edición en el sitio actual, con modal de confirmación (helper
  `CanEditInCurrentSite`).
- **Etiquetas de recurso** — etiquetas de color según el tipo y la clase del recurso, más
  una etiqueta de antigüedad de publicación basada en `dcterms:date`.
- **Navegación y búsqueda** — diseños de cuadrícula y lista con conmutador, opciones de
  truncado del cuerpo, y plantillas para el módulo
  [AdvancedSearch](https://gitlab.com/Daniel-KM/Omeka-S-module-AdvancedSearch).
- **Localización al español** — traducción completa (`language/es.po`).
- **Refuerzo de seguridad** — escapado de salida y validación de los ajustes del tema que
  se usan en bloques `<style>` y en atributos `href`.

El registro completo está en el historial de commits.

---

## Licencia

Este tema se distribuye bajo la **Licencia Pública General de GNU, versión 3.0**. El texto
completo está en [`LICENSE`](LICENSE).

Tanto el fichero `LICENSE` como las cabeceras del código proceden del proyecto original, y
conviene leerlos juntos: la cabecera de `asset/sass/style.scss` indica *"GNU General Public
License v2 or later"*, mientras que la licencia incluida es la v3. La cláusula *"or later"*
es lo que hace coherente ambas cosas: permite distribuir bajo la v3, que es lo que hace el
fichero `LICENSE` y lo que declara `package.json`.

### Qué implica si reutilizas este tema

La GPL es una licencia copyleft, así que redistribuirlo —modificado o no— conlleva
obligaciones:

1. **Conservar la licencia y los avisos de copyright.** No elimines `LICENSE` ni las
   cabeceras de los ficheros Sass.
2. **Distribuir bajo la misma licencia.** Las obras derivadas también deben ser GPL-3.0.
3. **Declarar los cambios**, como hace este README más arriba.
4. **Facilitar el código fuente.** Si distribuyes el tema, quien lo reciba debe poder
   obtener el código correspondiente, incluidas tus modificaciones.

Atribuir la autoría original no es aquí una mera cortesía: conservar los avisos es una
condición de la licencia.

### Recursos de terceros

- **Tipografías** — Open Sans y Noto Serif se cargan desde Google Fonts en tiempo de
  ejecución, y Material Symbols mediante un `@import` de Sass. No están incluidas en este
  repositorio. Ten en cuenta que esto genera una petición a Google en cada carga de
  página, lo que puede ser relevante para vuestra evaluación de privacidad; la mitigación
  es alojarlas localmente.
- **Iconos** — la tipografía de iconos de Omeka S la aporta la plataforma, no este tema.
- **Los logotipos institucionales** los suben las personas administradoras desde los
  ajustes del tema y no forman parte de este repositorio. Suelen estar sujetos a sus
  propias normas de uso, independientes de la licencia de este tema.

---

## Instalación

Para un uso normal, sigue las [instrucciones de instalación de temas del manual de Omeka
S](https://omeka.org/s/docs/user-manual/sites/site_theme/#installing-themes).

Requiere Omeka S `^4.1.0`.

Para trabajar sobre el Sass del tema necesitarás [Node.js](https://nodejs.org/en/). Desde
el directorio del tema:

```bash
npm install
```

---

## Ajustes del tema

Se configuran por sitio en *Sitios → [sitio] → Tema*.

### General
- **Color primario / secundario / de acento** — de ellos se derivan las propiedades
  personalizadas CSS sobre las que se construye la hoja de estilos. Solo se aceptan
  valores hexadecimales.

### Cabecera
- **Menú de cabecera** — muestra el menú de navegación; si se desactiva, solo aparecen el
  logotipo y el nombre del sitio.
- **Diseño de cabecera** — en línea, o logotipo y menú centrados.
- **Profundidad de la navegación** — número máximo de niveles del menú; 0 o vacío los
  muestra todos.
- **Logotipo** — el logotipo del sitio, junto al nombre.
- **Logotipo institucional** — se muestra arriba a la izquierda de la cabecera.
- **Enlace a la página de inicio** — logotipo opcional que enlaza a la página de inicio del
  servicio. Requiere logotipo **y** URL; si falta cualquiera de los dos, el enlace no se
  muestra.

### Banner
Imagen, titular, descripción, posición del contenido, anchura, altura, altura en móvil, y
posición vertical y horizontal de la imagen dentro de su contenedor.

### Pie de página
Logotipo, descripción del sitio, menú y profundidad del menú, contenido libre y aviso de
copyright.

### Redes sociales
URLs de Facebook, Twitter, LinkedIn, Instagram, YouTube y Mastodon. Solo se aceptan URLs
`http(s)`; cualquier otra cosa no se muestra.

### Ajustes de imagen
Borde decorativo para medios y/o recursos.

### Etiquetas de recurso
Muestra etiquetas según el tipo y/o la clase del recurso.

### Ajustes de navegación
Diseño de las páginas de listado (cuadrícula, lista, o cualquiera de las dos con
conmutador para quien visita) y truncado del cuerpo.

---

## Desarrollo

Comandos a ejecutar desde la raíz del tema:

| Comando | Función |
|---|---|
| `npm run start` | Vigila los ficheros Sass y recompila al guardar |
| `npx gulp css` | Compilación puntual de Sass a CSS |
| `npm run compile-translations` | Compila los ficheros `.po` a `.mo` |

> [!IMPORTANT]
> **`asset/css/style.css` es un fichero generado, pero está commiteado.** Después de
> modificar cualquier `.scss` hay que ejecutar la compilación y commitear el resultado; de
> lo contrario el repositorio publica una hoja de estilos que no se corresponde con sus
> propias fuentes. Ya ha ocurrido antes.

### Traducciones

Las cadenas están en `language/`. `template.pot` es la plantilla de extracción, `es.po` el
catálogo en español, y `es.mo` la versión compilada que Omeka carga realmente: hay que
regenerarla tras editar `es.po`.

### Sobrescritura de vistas

Las plantillas de `view/` sobrescriben las de Omeka S y las de los módulos. Omeka resuelve
los view scripts por ruta y el tema gana sobre el módulo, así que no hay que registrar nada
en `config/`. En `view/search/` están las sobrescrituras del módulo AdvancedSearch: copia
el partial original del módulo como punto de partida y edítalo aquí, sin tocar el módulo.

Cuando varias *search pages* necesiten diseños distintos, dale a cada una su propio nombre
de partial y apunta cada página al suyo; sobrescribir el partial canónico rompe las demás.

Si un cambio no aparece, vacía la caché de Omeka (`files/cache/`) y el OPcache de PHP antes
de buscar otras causas.

### Estructura del Sass

```bash
sass
    ├── abstracts        # variables (breakpoints, colores, layout, tipografía) y mixins
    ├── base             # elementos, layout y tipografía
    ├── components       # cabecera, pie, banner, navegación, bloques, recursos, facetas…
    ├── generic          # box-sizing, normalize
    └── utilities        # accesibilidad, alineaciones, clearfix
```

### Clases de utilidad

Clases predefinidas que pueden combinarse en cualquier elemento:

`inline` · `alignleft` · `alignright` · `aligncenter` · `alignfull` · `alignwide` ·
`alignnarrow` · `textleft` · `textright` · `textcenter` · `clearfix` · `screen-reader-text`
