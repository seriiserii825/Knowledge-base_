# c-client for php

For c-client add -Wno-error=implicit-function-declaration -Wno-error=incompatible-pointer-types to CFLAGS:

```
diff --git a/PKGBUILD b/PKGBUILD
index 635a4ad..8cdddeb 100644
--- a/PKGBUILD
+++ b/PKGBUILD
@@ -26,7 +26,7 @@ prepare() {

 build() {
   cd "$srcdir/$_pkgbase-src"
-  CFLAGS+=" -ffat-lto-objects"
+  CFLAGS+=" -ffat-lto-objects -Wno-error=implicit-function-declaration -Wno-error=incompatible-pointer-types"
   # NOTE: if you wish to enforce SSL, use SSLTYPE=unix.nopwd

   yes "y" | make -j1 lnp EXTRAAUTHENTICATORS=gss PASSWDTYPE=pam SPECIALAUTHENTICATORS=ssl SSLTYPE=unix EXTRACFLAGS="${CFLAGS} -fPIC -lgssapi_krb5 -lkrb5 -lk5crypto -lcom_err -lpam" EXTRALDFLAGS="${LDFLAGS}"
```

## install php83
```
sudo pacman -S php83
yay -S php83-mysql
```

## speed up aur
## Edit /etc/makepkg.conf

[](https://gist.github.com/beci/c737c89685a667053fe02f986d59ca44#edit-etcmakepkgconf)

### replace in CFLAGS and CXXFLAGS to use the native one

[](https://gist.github.com/beci/c737c89685a667053fe02f986d59ca44#replace-in-cflags-and-cxxflags-to-use-the-native-one)

`-march=x86-64 -mtune=generic` to `-march=native`

### speed up build by set multiple threads

[](https://gist.github.com/beci/c737c89685a667053fe02f986d59ca44#speed-up-build-by-set-multiple-threads)

`MAKEFLAGS="-j$(nproc)"`

~\### speedup package compression for XZ~ ~1\. use less aggressive compression. `-0` is the faster, I prefer `-2` (default is `-6`)~ ~2\. use all available thread `-T0` (or `-T8` for 8 threads)~

~`COMPRESSXZ=(xz -c -z -)` to `COMPRESSXZ=(xz -c -z -2 -T0 -)`~

As the default package extension became zst `PKGEXT='.pkg.tar.zst'`, the compression isn't hurt badly anymore, but it can be speed up by add the desired level to `COMPRESSZST`, like add `-1`:

```
COMPRESSZST=(zstd -1 -c -z -q -)
```

Женя, [6/15/24 3:18 PM]
в файле locale.gen

Женя, [6/15/24 3:18 PM]
/etc/locale.gen

Женя, [6/15/24 3:19 PM]
надо раскоментить нужные языки

Женя, [6/15/24 3:19 PM]
строки вот такого формата

Женя, [6/15/24 3:20 PM]
en_US.UTF-8 UTF-8 для инглиша

Женя, [6/15/24 3:21 PM]
ru_RU.UTF-8 UTF-8 для рашн

Женя, [6/15/24 3:21 PM]
и так далее

Женя, [6/15/24 3:21 PM]
сохраняешь и запускаешь команду locale-gen

Женя, [6/15/24 3:22 PM]
чтобы сгенерировать языки

Женя, [6/15/24 3:24 PM]
проверяешь localectl list-locales

Женя, [6/15/24 3:26 PM]
в /etc/locale.conf прописываешь такую строку

Женя, [6/15/24 3:26 PM]
LANG=en_US.UTF-8

Женя, [6/15/24 3:27 PM]
это язык в системе который будет

Женя, [6/15/24 3:30 PM]
по умолчанию

Женя, [6/15/24 3:31 PM]
localectl status или locale чтобы посмотреть
