### Install pass

```
sudo apt install pass
pass init serii
sudo apt install gnupg
```

### Generate key

Will need to add password for key

```
gpg --full-gen-key
```

Keys is stored in

```
$/.gnupg
```

```
$ gpg -k
/home/serii/.gnupg/pubring.kbx
------------------------------
pub   rsa2048 2020-06-17 [SC]
      17816E352FDDF047A999EB44B4319A3D90FA2450
uid           [ultimate] serii burduja (some) <seriiburduja@gmail.com>
sub   rsa2048 2020-06-17 [E]

```

pub - main key
sub - sub key
E - encrypt
C - create

### Check public key

```
gpg --list-keys
gpg -k
```

### Check private key

```
gpg --list-secret-keys
gpg -K
```

### export keys

```
gpg --export -a john > public.key
gpg --export-secret-key -a john > private.key
```

### Delete key

You need to delete first private and after public key

```
gpg --delete-secret-key E130BB49AAA234F2BE2A7F96714F9CBFDA191430
```

### Import key

```
gpg --import private.key
gpg --import public.key
```

### Edit key

```
gpg --list-secret-keys
gpg --edit-key <KEY_ID>
gpg> trust
```

Need to add trust 5

```
1 = I don't know or won't say
2 = I do NOT trust
3 = I trust marginally
4 = I trust fully
5 = I trust ultimately
m = back to the main menu

```

to exit type save

```
sec  2048R/920B1221 2013-12-01 [expires: 2014-12-01]
```

- `sec` – это primary private часть нашего ключа
- `4096R` – это собственно алгоритм и количество бит
- `920B1221` – это айди ключа, ну вернее последняя его часть, на самом деле он немного длиннее.
- `2013-12-01` – дата создания ключа
- `[expires: 2014-12-01]` – когда истекает ключ

uid

- `uid` – это что-то вроде идентификатора
- `Dmitriy Kovalev` – Это имя, которое мы задавали
- `123` – Это наш комментарий
- \`\` – имейл

```
ssb  2048R/2AB141A0 2013-12-01
```

- `ssb` – Это наш сабкей в приватной части нашего ключа
- `2048R` – его алгоритм
- `2AB141A0` – его айди
- `2013-12-01` – его дата создания

Когда мы создаем наш ключ, то это вообще все сохраняется в директории `~/.gnupg`

- `~/.gnupg/gpg.conf` - файл конфиругации
- `~/.gnupg/secring.gpg` - тут секретная часть ключей
- `~/.gnupg/pubring.gpg` - тут приватная часть ключей

## Sign

Теперь смотрите, мы можем взять какой-нибудь файл и подписать его с помощью команды

```
gpg --clearsign 1.txt
```

Давайте теперь откроем файл и посмотрим на него.

![img](https://i.imgur.com/shZxJph.png)

## Encrypt

Теперь давайте попробуем зашифровать какой-нибудь файл.

```
gpg -r johenews --armor --encrypt 1.txt
```

Теперь откроем его.

![img](https://i.imgur.com/1cPCev1.png)

Видим, что файл зашифрован.
А теперь расшифруем его.

```
gpg -d 1.txt.asc
```

![img](https://i.imgur.com/ANCAz4n.png)

Ну, вот как-то так.
