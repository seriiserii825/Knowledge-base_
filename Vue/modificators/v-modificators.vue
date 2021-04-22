//Stop propagation
<span @mousemove.stop="" style="background: lightcyan;">no change</span>

// Prevent default
<a @click.prevent="">no change</a>

//Enter
<input type="text" @keyup.enter="alertValue">
