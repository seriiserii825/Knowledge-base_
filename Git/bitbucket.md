# Два акаунта на bitbucket

## Создание ключей

`ssh-keygen -f ~/.ssh/sites-bludelego -C "bludelego@gmail.com"`

## Добавление ssh

`ssh-add ~/.ssh/sites-bludelego`

## Копирование публичного ключа

`xclip -sel clip < ~/.ssh/sites-bludelego.pub`

## Добавление кода в  ~/.ssh/config file.

```javascript
Host bitbucket.org
Hostname bitbucket.org
IdentityFile ~/.ssh/id_rsa
```

```javascript
Host bitbucket.org-b
Hostname bitbucket.org
PreferredAuthentications publickey
IdentityFile ~/.ssh/sites-bludelego
```
