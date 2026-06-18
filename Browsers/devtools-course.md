# Chrome DevTools Learning Plan

https://developer.chrome.com/docs/devtools/overview
https://developer.chrome.com/docs/devtools/dom?hl=ru#edit

## Goal

Learn Chrome DevTools beyond basic inspection and gain practical skills for debugging, performance analysis, memory leak detection, and network troubleshooting in real-world Vue, NestJS, WordPress, and MapLibre projects.

---

# Day 1 — Elements Panel

## Topics

- Select Element (`Ctrl + Shift + C`)
- Edit HTML
- Edit CSS
- Force States (`:hover`, `:focus`, `:active`)
- Computed Styles
- Box Model
- CSS Grid Overlay
- Flexbox Overlay

## Practice

Using one of your projects:

- Find an element
- Modify styles live
- Change spacing and dimensions
- Simulate hover state
- Find which CSS rule overrides another

---

# Day 2 — Network Panel

## Topics

- Fetch/XHR requests
- Headers
- Query Parameters
- Request Payload
- Response Body
- Timing
- Waterfall

## Practice

Using your NestJS or GraphQL API:

- Inspect requests
- Inspect responses
- Inspect cookies
- Inspect CORS headers

Useful actions:

- Copy as Fetch
- Copy as cURL
- Replay Request
- Block Request URL

---

# Day 3 — JavaScript Debugging

## Topics

- Breakpoints
- Conditional Breakpoints
- Logpoints
- Watch Expressions
- Scope
- Call Stack

## Practice

Set a normal breakpoint:

```js
if (price > 1000) {
}
```

Convert it to a conditional breakpoint:

```js
price > 1000;
```

Inspect variables, scope, and call stack.

---

# Day 4 — Advanced Breakpoints

## Topics

### XHR / Fetch Breakpoints

Pause execution when requests occur:

```text
/api/user
```

### Event Listener Breakpoints

Useful events:

```text
click
keydown
submit
change
```

### DOM Breakpoints

Pause execution when:

- Element is removed
- Attributes change
- Children change

Useful for finding:

```js
element.remove();
```

or unexpected DOM modifications.

---

# Day 5 — Performance Panel

## Topics

- Record Performance Profile
- Flame Chart
- Long Tasks
- Layout
- Paint
- Composite
- Recalculate Style

## Practice

Using MapLibre:

1. Start recording.
2. Move and zoom the map.
3. Stop recording.

Analyze:

- Layout time
- Paint time
- Style recalculation
- Long tasks

---

# Day 6 — Rendering Tools

## Open Rendering Panel

```text
Ctrl + Shift + P
```

Search:

```text
Show Rendering
```

## Enable

```text
Paint Flashing
FPS Meter
Layout Shift Regions
Layer Borders
```

## Practice

Test:

- Vue transitions
- GSAP animations
- Swiper sliders
- MapLibre rendering

Observe:

- Repaints
- FPS drops
- Layout shifts

---

# Day 7 — Memory Analysis

## Topics

- Heap Snapshot
- Allocation Timeline
- Detached DOM Nodes

## Practice

Create a memory leak:

```js
setInterval(() => {
  document.body.appendChild(document.createElement("div"));
}, 100);
```

Take Heap Snapshots and identify:

- Detached DOM Nodes
- Growing memory usage
- Retained objects

Then test a real project:

- Open page
- Navigate away
- Check if memory is released

Especially verify:

- MapLibre instances
- Event listeners
- Timers
- Watchers

---

# Application Panel

## Topics

- Cookies
- LocalStorage
- SessionStorage
- IndexedDB
- Cache Storage

## Practice

- Inspect authentication cookies
- Modify LocalStorage values
- Inspect session data
- Clear storage manually

---

# Coverage Tool

## Open

```text
Ctrl + Shift + P
Coverage
```

## Purpose

Measure unused CSS and JavaScript.

Example:

```text
JS used: 12%
CSS used: 7%
```

Useful for:

- WordPress themes
- Vue applications
- Bundle optimization

---

# Lighthouse

## Analyze

- Performance
- Accessibility
- Best Practices
- SEO

Run audits on your projects and fix the reported issues.

---

# Advanced Topics (After Completing Everything Above)

## Performance Insights

Modern performance diagnostics.

## Recorder

Record user interactions and replay them.

## Protocol Monitor

Inspect Chrome DevTools Protocol messages.

## Workspaces

Connect DevTools directly to project files.

## Local Overrides

Override:

- CSS
- JavaScript
- HTML
- API responses

without modifying source code.

---

# Priority for Vue / NestJS / WordPress / MapLibre

| Feature     | Importance |
| ----------- | ---------- |
| Network     | ⭐⭐⭐⭐⭐ |
| Sources     | ⭐⭐⭐⭐⭐ |
| Application | ⭐⭐⭐⭐⭐ |
| Performance | ⭐⭐⭐⭐   |
| Rendering   | ⭐⭐⭐⭐   |
| Memory      | ⭐⭐⭐⭐   |
| Elements    | ⭐⭐⭐     |
| Lighthouse  | ⭐⭐⭐     |
| Coverage    | ⭐⭐⭐     |

---

# Daily Workflow Every Developer Should Use

1. Check Network first.
2. Use Breakpoints instead of console.log when debugging.
3. Inspect LocalStorage, Cookies, and Sessions.
4. Record Performance when UI feels slow.
5. Use Rendering tools for animations.
6. Use Memory tools when components or maps are frequently mounted/unmounted.
7. Run Lighthouse before production releases.
