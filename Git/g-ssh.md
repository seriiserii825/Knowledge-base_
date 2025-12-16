### generate key

```bash
ssh-keygen -t ed25519 -C "seriiburduja@mail.com"
```

### add name for the key
When asked for file name, add /home/webmaster/.ssh/id_ed25519_github

You’ll get:

id_ed25519_github
id_ed25519_github.pub

### Add the key to ssh-agent
```bash
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519_github
```

```bash
ssh-add -l
```
### 3️⃣ Add the public key to GitHub

Copy the public key:

```bash
cat ~/.ssh/id_ed25519_github.pub
```

Then on GitHub:

Settings → SSH and GPG keys → New SSH key
Paste the key
