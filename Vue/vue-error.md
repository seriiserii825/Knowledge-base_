Show DevTools in Chrome (F12)
Load the page that causes "the client-side rendered virtual DOM tree..." warning.
Scroll to the warning in DevTools console.
Click at the source location hyperlink of the warning (in my case it was vue.runtime.esm.js:574).
Set a breakpoint there (left-clicking at line number in the source code browser).
Make the same warning to appear again. I'm not saying it is always possible, but in my case I simply reloaded the page. If there are many warnings, you can check the message by moving a mouse over msg variable.
When you found your message and stopped on a breakpoint, look at the call stack. Click one frame down to call to "patch" to open its source. Hover mouse over hydrate function call 4 lines above the execution line in patch. Hyperlink to the source of hydrate would open.
In the hydrate function, move about 15 lines from the start and set a breakpoint where false is returned after assertNodeMatch returned false. Set the breakpoint there and remove all other breakpoints.
Make the same warning to happen again. Now, when breakpoint is hit, execution should stop in the hydrate function. Switch to DevTools console and evaluate elm and then vnode. Here elm seem to be a server-rendered DOM element while vnode is a virtual DOM node. Elm is printed as HTML so you can figure out where the error happened.
