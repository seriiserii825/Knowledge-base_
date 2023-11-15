## vue

yarn create vite

- project name
- vue
- typescript

## Install CRXJS Vite plugin[​](https://crxjs.dev/vite-plugin/getting-started/vue/create-project#install-crxjs-vite-plugin "Direct link to heading")

Now install the CRXJS Vite plugin using your favorite package manager.

- Vite 2
- Vite 3 (beta)

```
npm i @crxjs/vite-plugin@latest -D
```

```
npm i @crxjs/vite-plugin@beta -D
```

package.json

Check `package.json` to ensure that `"type": "module"` is set. If this package key is missing, Vite might not be able to build `vite.config.ts`.

## Update the Vite config[​](https://crxjs.dev/vite-plugin/getting-started/vue/create-project#update-the-vite-config "Direct link to heading")

Update `vite.config.js` to match the code below.

vite.config.js

```
import { defineConfig } from 'vite'import vue from '@vitejs/plugin-vue'import { crx } from '@crxjs/vite-plugin'import manifest from './manifest.json' // Node 14 & 16import manifest from './manifest.json' assert { type: 'json' } // Node >=17export default defineConfig({  plugins: [    vue(),    crx({ manifest }),  ],})
```

Create a file named `manifest.json` next to `vite.config.js`.

manifest.json

```
{  "manifest_version": 3,  "name": "CRXJS Vue Vite Example",  "version": "1.0.0",  "action": { "default_popup": "index.html" }}
```

## First development build[​](https://crxjs.dev/vite-plugin/getting-started/vue/create-project#first-development-build "Direct link to heading")

Time to run the dev command. 🤞

```
npm run dev
```

## keyboards

Any keyboard shortcut must use either Ctrl (Command in Mac) or Alt but cannot include both. We can also use Shift.
Other supported keys: A-Z, 0-9, Comma, Period, Home, End, PageUp, PageDown, Space, Insert, Delete, Arrow keys (Up, Down, Left, Right) and the Media Keys (MediaNextTrack, MediaPlayPause, MediaPrevTrack, MediaStop).
Examples: Ctrl + Shift + L, Alt + Shift + L Command + , Ctrl + Shift + 1
