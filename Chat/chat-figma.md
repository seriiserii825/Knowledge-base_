# Установка Figma MCP

Самый простой способ — официальный плагин:

    claude plugin install figma@claude-plugins-official

После установки перезапусти Claude Code, введи /plugin, перейди во вкладку **Installed**, выбери **Figma** и пройди авторизацию через браузер.  
GitHub

---

# Как читать макет — два способа

## 1. По ссылке (основной способ)

Открой Figma, выдели нужный фрейм или слой, нажми правой кнопкой → **Copy link to selection**.

Вставь ссылку в Claude Code:

    реализуй этот компонент: https://figma.com/file/xxx/...?node-id=123

Figma Help Center

---

## 2. По выделению

Выдели фрейм прямо в Figma, затем в Claude Code напиши:

    сверстай компонент на основе моего текущего выделения в Figma
