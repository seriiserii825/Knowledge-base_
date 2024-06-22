# c-client for php

For c-client add -Wno-error=implicit-function-declaration -Wno-error=incompatible-pointer-types to CFLAGS:
```
git clone https://aur.archlinux.org/c-client.git ~/c-client
cd c-client
change in PKGBUILD
```

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

```
makepkg -si
```
