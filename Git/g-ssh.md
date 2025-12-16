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

### 4️⃣ Configure SSH to use correct keys (IMPORTANT)

Create or edit SSH config:

```bash
vi ~/.ssh/config
```

Add this:

```vim

# GitHub
Host github.com
  HostName github.com
  User git
  IdentityFile ~/.ssh/id_ed25519_github
  IdentitiesOnly yes

# Bitbucket (your existing key)
Host bitbucket.org
  HostName bitbucket.org
  User git
  IdentityFile ~/.ssh/id_rsa
  IdentitiesOnly yes
```

Fix permissions (very important):

```bash
chmod 600 ~/.ssh/config
```

### 5️⃣ Test connection

```bash
ssh -T git@github.com
```

Expected:

Hi <username>! You've successfully authenticated, but GitHub does not provide shell access.

And Bitbucket still works:

ssh -T git@bitbucket.org
