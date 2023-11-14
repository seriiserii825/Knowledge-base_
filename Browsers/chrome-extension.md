https://dev.to/paulasantamaria/adding-shortcuts-to-your-chrome-extension-2i20
## Creating a Chrome extension involves several steps. Here's a simplified guide:

## Set Up Your Development Environment:

Make sure you have a text editor (like Visual Studio Code) installed.
Download and install Google Chrome if you haven't already.
Create a Manifest File:

Every Chrome extension needs a manifest file. Create a file named manifest.json with essential information about your extension.
Example manifest.json:

```

{
  "manifest_version": 2,
  "name": "Your Extension Name",
  "version": "1.0",
  "description": "Description of your extension",
  "permissions": ["activeTab"],
  "browser_action": {
    "default_icon": "icon.png",
    "default_popup": "popup.html"
  },
  "icons": {
    "48": "icon.png"
  }
}
```
Any keyboard shortcut must use either Ctrl (Command in Mac) or Alt but cannot include both. We can also use Shift.

Other supported keys: A-Z, 0-9, Comma, Period, Home, End, PageUp, PageDown, Space, Insert, Delete, Arrow keys (Up, Down, Left, Right) and the Media Keys (MediaNextTrack, MediaPlayPause, MediaPrevTrack, MediaStop).

Examples: Ctrl + Shift + L, Alt + Shift + L Command + , Ctrl + Shift + 1
