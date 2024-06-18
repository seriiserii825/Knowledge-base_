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
