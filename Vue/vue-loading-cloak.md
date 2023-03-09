<div id="app" v-cloak></div>

[v-cloak]>* {
  display: none
}
[v-cloak]::before {
  content: "loading…"
}
