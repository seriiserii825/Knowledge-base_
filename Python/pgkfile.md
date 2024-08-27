The best way that I have found until now is to use the `pkgfile` command.  
You could install it by:

```
# sudo pacman -S pkgfile
```

according to the [official arch wiki](https://wiki.archlinux.org/index.php/Pkgfile),

> pkgfile is a tool for searching _files_ from packages in the [official repositories.](https://wiki.archlinux.org/index.php/Official_repositories)

(_files_ being the binaries you mentioned as bash commands).

You can also update its database by running:

```
# pkgfile -u
```

or you could just enable its systemd timer for it to update automatically:

```
# systemctl enable pkgfile-update.timer
# systemctl start pkgfile-update.timer
```

awsome, right ?! :)

### Example

```
# pkgfile netstat
core/net-tools
extra/munin-node

# pkgfile netstat --verbose
core/net-tools 1.60.20160710git-1       /usr/bin/netstat
extra/munin-node 2.0.26-2               /usr/lib/munin/plugins/netstat
```
